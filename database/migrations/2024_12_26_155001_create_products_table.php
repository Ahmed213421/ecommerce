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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('price');
            $table->string('stripe_price_id')->nullable();
            $table->decimal('discount_percentage')->default(0);
            $table->integer('price_after_discount')->storedAs('price - (price * discount_percentage / 100)'); // Discounted price
            $table->integer('quantity')->default(1);
            $table->foreignId('subcategory_id')->constrained();
            $table->text('imagepath')->nullable();
            $table->integer('views')->default(0);
            $table->integer('featured')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
