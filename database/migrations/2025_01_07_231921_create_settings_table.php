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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('logo')->nullable();
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->text('description')->nullable();
            $table->text('hours_working')->nullable();
            $table->text('whoweare')->nullable();
            $table->text('pageIcon')->nullable();
            $table->text('map')->nullable();
            $table->decimal('tax_rate', 5, 2)->default(0.20);
            $table->string('email')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
