<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('quality')->nullable(false);
            $table->foreignId('departure_city_id')->constrained('cities')->onDelete('cascade');
            $table->foreignId('destination_city_id')->constrained('cities')->onDelete('cascade');
            $table->integer('seats_quantity')->nullable(false);
            $table->decimal('ticket_cost')->nullable(false);
            $table->dateTime('departure_time')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
