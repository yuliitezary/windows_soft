<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Fulfillments;

use App\Models\User;
use App\Models\UserDonation;
use Carbon\Carbon;
use DB;

/**
 * Applies a Supporter Tag donation from a store transaction.
 */
class ApplySupporterTag extends OrderItemFulfillment
{
    public static function addDuration(Carbon $time, int $duration): Carbon
    {
        // round(365 / 12 * 24) = 730
        // (it's 730.485 if accounting actual year (365.2425) but still close enough)
        return $time->addHours($duration * 730);
    }

    private int $amount;
    private int $duration;
    private User $donor;
    private User $target;

    public function cancelledTransactionId()
    {
        return "{$this->getTransactionId()}-cancel";
    }

    /**
     * Performs the opration.
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException If the donor or target could not be found.
     */
    public function run()
    {
        $this->setup();

        DB::transaction(function () {
            // check if transaction was already applied.
            if (UserDonation::where('transaction_id', $this->getTransactionId())->count() > 0) {
                \Log::info("{$this->getTransactionId()} already exists in UserDonations!");

                return;
            }

            $donation = $this->applyDonation();
            $this->updateVotes($this->duration);
            $this->applySubscription();

            $donation->saveOrExplode();
            $this->donor->saveOrExplode();
            $this->target->saveOrExplode();
        });
    }

    /**
     * Revokes the operation.
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException If the donor or target could not be found.
     */
    public function revoke()
    {
        $this->setup();

        DB::transaction(function () {
            // cancel only if applied.
            if (UserDonation::where('transaction_id', $this->cancelledTransactionId())->count() > 0) {
                \Log::info("{$this->cancelledTransactionId()} already exists in UserDonations!");

                return;
            }

            $donations = UserDonation::where('transaction_id', $this->getTransactionId())->get();
            if ($donations->count() === 0) {
                \Log::info("{$this->getTransactionId()} nothing to revoke!");

                return;
            }

            foreach ($donations as $donation) { // loop, but there should only be one.
                $donation->cancel($this->cancelledTransactionId());
                $this->updateVotes(-$this->duration);
                $this->revokeSubscription();

                $this->donor->saveOrExplode();
                $this->target->saveOrExplode();
            }
        });
    }

    private function updateVotes($duration)
    {
        $this->donor->osu_featurevotes += $duration * 2;
    }

    private function applyDonation()
    {
        return new UserDonation([
            'transaction_id' => $this->getTransactionId(),
            'user_id' => $this->donor->getKey(),
            'target_user_id' => $this->target->getKey(),
            'length' => $this->duration,
            'amount' => $this->amount,
        ]);
    }

    private function applySubscription()
    {
        // start fresh if was an existing subscriber and expired.
        // null < $now = true.
        $new = static::addDuration(max(Carbon::now(), $this->target->osu_subscriptionexpiry), $this->duration);
        $this->target->osu_subscriptionexpiry = $new;
        $this->target->osu_subscriber = true;
    }

    private function revokeSubscription()
    {
        $previous = static::addDuration($this->target->osu_subscriptionexpiry, -$this->duration);
        $this->target->osu_subscriptionexpiry = $previous;
        $this->target->osu_subscriber = Carbon::now()->diffInMinutes($previous, false) > 0;
    }

    private function setup()
    {
        /** @var ExtraDataSupporterTag $extraData */
        $extraData = $this->orderItem->extra_data;

        $this->amount = $this->orderItem->cost;
        $this->duration = $extraData->duration;

        $this->donor = User::findOrFail($this->orderItem->order->user_id);
        $this->target = User::findOrFail($extraData->targetId);
    }
}
