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
        Schema::create('accomodations', function (Blueprint $table) {
            $table->id();

            $table->string('roomType');
            $table->string('slug')->unique();
            $table->string('roomSize');
            $table->integer('noRoom');
            $table->integer('occupancy');
            $table->integer('rakeRate');
            $table->longText('description');
            $table->text('image');
            $table->boolean('status')->default(1)->nullable()->comment('1: Published; 0: Unpublished');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accomodations');
    }
};
