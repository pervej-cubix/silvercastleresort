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
        Schema::create('available_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_type');
    
            // 32 day-based availability columns
            for ($i = 1; $i <= 32; $i++) {
                $table->integer("d{$i}")->nullable()->default(0); // nullable and default 0
            }
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_rooms');
    }
};
