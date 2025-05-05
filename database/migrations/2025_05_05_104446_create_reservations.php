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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->integer('pax_in')->nullable();
            $table->integer('child_in')->nullable();
            $table->string('country')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('guest_remarks')->nullable();

            $table->integer('day_count')->nullable();
            $table->tinyInteger('reservation_mode')->default(1);
            $table->tinyInteger('currency_type')->default(1);
            $table->float('conversion_rate')->default(1);
            $table->integer('guest_source_id')->default(1);
            $table->integer('reference_id')->nullable();
            $table->tinyInteger('reservation_status')->default(1);
            $table->softDeletes();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
