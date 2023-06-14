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
        Schema::create('detailsales', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('sale_id')->nullable();
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->string('medicine_id')->nullable();
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->unsignedInteger('quantity');
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('subtotal', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailsales');
    }
};
