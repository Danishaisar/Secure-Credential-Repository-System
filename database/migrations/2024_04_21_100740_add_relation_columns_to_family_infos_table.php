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
            $table->string('relation_1')->nullable()->after('kin_email_1');  // Add relation for kin_email_1
            $table->string('relation_2')->nullable()->after('kin_email_2');  // Add relation for kin_email_2
            $table->string('relation_3')->nullable()->after('kin_email_3');  // Add relation for kin_email_3
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('family_infos', function (Blueprint $table) {
            $table->dropColumn('relation_1');
            $table->dropColumn('relation_2');
            $table->dropColumn('relation_3');
        });
    }
};
