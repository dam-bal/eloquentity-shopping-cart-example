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
        Schema::create('checkout_carts', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignIdFor(\App\Models\Customer::class);
            $table->string('address_city');
            $table->string('address_street_name');
            $table->string('address_street_number');
            $table->string('payment_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_carts');
    }
};
