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
        Schema::create('tenant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // Foreign key to users table
            $table->string('image')->nullable();
            $table->string('national_id', 10)->nullable();
            $table->string('nid_front_image')->nullable(); // NID Front Image
            $table->string('nid_back_image')->nullable();  // NID Back Image
            $table->string('passport_number', 20)->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->enum('user_type', ['with-family', 'sublet', 'mess-member'])->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('profession')->nullable();
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant');
    }
};
