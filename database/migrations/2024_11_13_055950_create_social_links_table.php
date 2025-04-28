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
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');
            $table->text('map_link');
            $table->text('fb_link');
            $table->text('instagram_link');
            $table->text('youtube_link');
            $table->text('whatsapp_link');
            $table->boolean('status')->default(1)->nullable()->comment('1: Published; 0: Unpublished');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_links');
    }
};
