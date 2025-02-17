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
        Schema::table('property', function (Blueprint $table) {
            $table->string('building_name')->nullable()->after('homeowner_id'); // Add after a specific column
            $table->string('building_address')->nullable()->after('building_name');
        });
    }

    public function down()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->dropColumn('building_name');
            $table->dropColumn('building_address');
        });
    }
};
