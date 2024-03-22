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
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('shipment_city')->nullable();
            $table->string('shipment_street_name')->nullable();
            $table->string('shipment_street_number')->nullable();
            $table->string('shipment_receiver_full_name')->nullable();
            $table->enum('payment_method', ['cash', 'card'])->nullable();
            $table->foreignIdFor(\App\Models\Customer::class, 'customer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
