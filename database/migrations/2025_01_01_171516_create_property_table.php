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
        Schema::create('property', function (Blueprint $table) { // Table name pluralized for convention
            $table->id();
            $table->unsignedBigInteger('homeowner_id'); // Foreign key column
            $table->string('building_image')->nullable();
            $table->string('holding_number')->nullable();
            $table->string('holding_tax_number')->nullable();
            $table->string('google_map_link')->nullable();
            $table->string('total_flat')->nullable();
            $table->string('total_floor')->nullable();
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('homeowner_id')
                ->references('id')
                ->on('homeowner') // Ensure this matches the exact homeowners table name
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties'); // Ensure this matches the table name
    }
};
