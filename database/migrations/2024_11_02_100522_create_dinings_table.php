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
        Schema::create('dinings', function (Blueprint $table) {
            $table->id();

            $table->string('diningName');
            $table->text('description');
            $table->string('Features1');
            $table->string('Features2');
            $table->string('Features3')->nullable();
            $table->string('Features4')->nullable();
            $table->string('Features5')->nullable();
            $table->string('Features6')->nullable();
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
        Schema::dropIfExists('dinings');
    }
};
