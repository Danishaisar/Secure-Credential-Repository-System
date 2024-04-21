<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('family_infos', function (Blueprint $table) {
         $table->boolean('verified')->after('additional_info')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('family_infos', function (Blueprint $table) {
            $table->dropColumn('verified');
        });
    }
};
