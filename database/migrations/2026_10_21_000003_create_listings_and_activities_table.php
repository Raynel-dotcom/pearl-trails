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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['Hotel', 'Lodge', 'Hostel', 'Restaurant', 'Tourist site', 'Recreation centre']);
            $table->string('name');
            $table->foreignId('destination_id')->nullable()->constrained()->nullOnDelete();
            $table->string('custom_location')->nullable();
            $table->unsignedInteger('price_ugx');
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('contact');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });

        Schema::create('listing_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('fee_ugx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_activities');
        Schema::dropIfExists('listings');
    }
};
