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
        Schema::table('products', function (Blueprint $table) {
            $table->string('serial_number')->nullable();
            $table->string('make_or_brand')->nullable();
            $table->integer('ram')->nullable(); // Assuming RAM is stored as an integer (GB)
            $table->integer('storage_capacity')->nullable(); // Assuming storage capacity is in GB
            $table->string('gpu')->nullable();
            $table->boolean('is_obsolete')->default(false);
            $table->boolean('is_written_off')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['serial_number', 'make_or_brand', 'ram', 'storage_capacity', 'gpu', 'is_obsolete', 'is_written_off']);
       
        });
    }
};
