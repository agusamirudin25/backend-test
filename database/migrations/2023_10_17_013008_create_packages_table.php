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
        Schema::create('packages', function (Blueprint $table) {
            $table->uuid("transaction_id")->primary();
            $table->string("location_id");
            $table->integer("organization_id");
            $table->uuid("connote_id");
            $table->string("customer_code");

            $table->string("customer_name");
            $table->bigInteger("transaction_amount");
            $table->bigInteger("transaction_discount");
            $table->string("transaction_additional_field");
            $table->integer("transaction_payment_type");
            $table->string("transaction_state");
            $table->string("transaction_code");
            $table->integer("transaction_order");
            $table->string("transaction_payment_type_name");
            $table->bigInteger("transaction_cash_amount");
            $table->bigInteger("transaction_cash_change");
            $table->string("customer_attribute");
            $table->string("custom_field");
            $table->string("currentLocation");

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
