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
        Schema::create('reservation_room_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')
                  ->constrained('reservations')
                  ->onDelete('cascade'); // delete child rows if reservation deleted

            $table->string('room_type');
            $table->integer('no_of_room');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_room_types');
    }
};
