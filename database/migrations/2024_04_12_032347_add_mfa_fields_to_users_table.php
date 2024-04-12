<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Add fields for storing MFA code and expiration.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mfa_code')->nullable()->after('password');
            $table->dateTime('mfa_expires_at')->nullable()->after('mfa_code');
        });
    }

    /**
     * Reverse the migrations.
     * Remove MFA fields if the migration is rolled back.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mfa_code', 'mfa_expires_at']);
        });
    }
};
