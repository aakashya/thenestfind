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
    Schema::create('cities', function (Blueprint $table) {
        $table->id();
        $table->string('city_name');
        $table->string('slug')->unique();
        $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
        $table->enum('status', ['available', 'coming_soon'])->default('available');
        $table->string('image')->nullable(); // Stores city image path
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
