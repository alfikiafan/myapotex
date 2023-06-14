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
            $table->id();
            $table->foreignId('sale_id')->nullable()->constrained(table: 'sales');
            $table->foreignId('medicine_id')->nullable()->constrained(table: 'medicine');
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
