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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('region');
            $table->decimal('lat', 10, 6);
            $table->decimal('lon', 10, 6);
            $table->text('description');
            $table->json('attractions')->nullable();
            $table->json('activities')->nullable();
            $table->json('interests')->nullable();
            $table->json('styles')->nullable();
            $table->json('groups')->nullable();
            $table->string('difficulty')->default('Easy');
            $table->string('best_time')->nullable();
            $table->unsignedInteger('min_days')->default(1);
            $table->unsignedInteger('max_days')->default(7);
            $table->unsignedInteger('rec_days')->default(3);
            $table->json('accommodation_costs')->nullable(); // budget, moderate, luxury per night
            $table->unsignedInteger('food_cost')->default(30000);
            $table->unsignedInteger('activity_cost')->default(50000);
            $table->unsignedInteger('local_transport_cost')->default(20000);
            $table->json('preferred_trip_types')->nullable();
            $table->json('hotel_names')->nullable(); // per style
            $table->text('tips')->nullable();
            $table->text('safety')->nullable();
            $table->string('gradient_from')->default('#0F4C3A');
            $table->string('gradient_to')->default('#D4AF37');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
