<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCloseKinEmailFromUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * Remove the 'close_kin_email' column from the 'users' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('close_kin_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Add the 'close_kin_email' column back to the 'users' table in case of rollback.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('close_kin_email')->nullable();
        });
    }
}
