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
        Schema::create('sales', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('cashier_id')->nullable();
            $table->foreign('cashier_id')->references('id')->on('users');
            $table->unsignedInteger('discount')->nullable();
            $table->decimal('total', 12, 2);
            $table->decimal('cash', 12, 2);
            $table->decimal('change', 12, 2);
            $table->boolean('is_success')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
