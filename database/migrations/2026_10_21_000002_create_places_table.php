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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->enum('category', ['eat', 'recreation', 'visit', 'stay']);
            $table->string('name');
            $table->unsignedInteger('price_ugx');
            $table->string('unit'); // meal, entry, night
            $table->string('type')->nullable(); // Hostel/Budget, Lodge/Moderate, Hotel/Luxury, etc.
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
