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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->nullable()->constrained('tools'); // puede ser null si es un product
            $table->foreignId('product_id')->nullable()->constrained('products'); // puede ser null si es un tool
            $table->foreignId('user_id')->constrained('users');
            $table->integer('cantidad')->default(1); // cantidad prestada
            $table->boolean('devuelto')->default(false); // para saber si ya fue devuelto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
