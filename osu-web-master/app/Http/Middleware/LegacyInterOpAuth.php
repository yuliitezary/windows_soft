<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Libraries\OsuAuthorize;
use Carbon\Carbon;
use Closure;

class LegacyInterOpAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $timestamp = $request->query('timestamp');
        $diff = Carbon::createFromTimestamp($timestamp)->diffInSeconds();
        $signature = $request->header('X-LIO-Signature');
        // don't use $request->fullUrl() because it returns normalised url.
        $fullUrl = $request->getSchemeAndHttpHost().$request->getRequestUri();
        $expected = hash_hmac('sha1', $fullUrl, config('osu.legacy.shared_interop_secret'));

        if (!present($signature) || !present($timestamp) || $diff > 300 || !hash_equals($expected, $signature)) {
            $reason = match (true) {
                !present($signature) => 'missing_signature',
                !present($timestamp) => 'missing_timestamp',
                $diff > 300 => 'expired_signature',
                !hash_equals($expected, $signature) => 'invalid_signature',
            };

            abort(403, "{$reason} ({$fullUrl})");
        }

        request()->attributes->set(OsuAuthorize::REQUEST_IS_INTEROP_KEY, true);

        return $next($request);
    }
}
