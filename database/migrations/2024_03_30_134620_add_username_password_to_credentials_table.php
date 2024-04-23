<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('credentials', function (Blueprint $table) {
            $table->string('username')->after('user_id'); // Add username field after user_id
            $table->text('password')->after('username'); // Add password field after username for plaintext data
        });
    }

    public function down(): void {
        Schema::table('credentials', function (Blueprint $table) {
            $table->dropColumn(['username', 'password']); // Drop both columns when rolling back the migration
        });
    }
};

