<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class SetCompressedRowFormatOnSoloScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->setRowFormat('solo_scores', 'COMPRESSED');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->setRowFormat('solo_scores', 'DEFAULT');
    }

    private function setRowFormat($table, $format)
    {
        DB::statement("ALTER TABLE `{$table}` ROW_FORMAT={$format};");
    }
}
