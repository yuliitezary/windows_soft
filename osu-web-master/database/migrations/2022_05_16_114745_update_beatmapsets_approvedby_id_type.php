<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_beatmapsets', function (Blueprint $table) {
            $table->integer('approvedby_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DBAL, which is used to execute `change()`, doesn't support `mediumInteger`.
        DB::statement('ALTER TABLE osu_beatmapsets MODIFY approvedby_id MEDIUMINT UNSIGNED DEFAULT NULL');
    }
};
