<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('credentials', function (Blueprint $table) {
            $table->string('username')->after('user_id'); // Add the username column
            $table->text('password')->after('username'); // Add the password column
        });
    }

    public function down(): void
    {
        Schema::table('credentials', function (Blueprint $table) {
            $table->dropColumn('username'); // Remove the username column
            $table->dropColumn('password'); // Remove the password column
        });
    }
};
