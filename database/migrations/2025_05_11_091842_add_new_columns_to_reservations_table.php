<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Add new columns to the table
            $table->integer('reservation_mode')->default(1);
            $table->integer('currency_type')->default(1);
            $table->decimal('conversion_rate', 8, 2)->default(1.00);
            $table->integer('guest_source_id')->default(1);
            $table->integer('reference_id')->default(29);
            $table->integer('reservation_status')->default(-1);
            $table->decimal('totalAmount', 10, 2)->default(0.00);
            $table->decimal('payableAmount', 10, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Drop the columns if we need to roll back
            $table->dropColumn('reservation_mode');
            $table->dropColumn('currency_type');
            $table->dropColumn('conversion_rate');
            $table->dropColumn('guest_source_id');
            $table->dropColumn('reference_id');
            $table->dropColumn('reservation_status');
            $table->dropColumn('totalAmount');
            $table->dropColumn('payableAmount');
        });
    }
};
