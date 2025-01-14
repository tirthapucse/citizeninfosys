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
        Schema::create('rent', function (Blueprint $table) {
            $table->id(); // Auto-increment ID for primary key
            $table->unsignedBigInteger('tenant_id'); // Foreign key for tenants
            $table->unsignedBigInteger('property_id'); // Foreign key for properties
            $table->boolean('status')->default(0); // Status field (binary)

            // Define foreign key constraints
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenant')
                ->onDelete('cascade');

            $table->foreign('property_id')
                ->references('id')
                ->on('property')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent');
    }
};
