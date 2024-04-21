<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('family_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key referencing the 'users' table
            $table->string('kin_email_1')->nullable();
            $table->string('kin_email_2')->nullable();
            $table->string('kin_email_3')->nullable(); // Optional tertiary kin email
            $table->text('additional_info')->nullable();  // Any additional information about the user's family
            $table->timestamps();  // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_infos');
    }
};
