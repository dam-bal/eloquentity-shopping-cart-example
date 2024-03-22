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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('shipment_city');
            $table->string('shipment_street_name');
            $table->string('shipment_street_number');
            $table->string('shipment_receiver_full_name');
            $table->enum('status', ['placed', 'completed', 'canceled'])->nullable();
            $table->enum('payment_method', ['cash', 'card'])->nullable();
            $table->foreignIdFor(\App\Models\Customer::class, 'customer_id');
            $table->dateTime('placed_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
