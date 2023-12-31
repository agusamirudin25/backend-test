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
        Schema::create('connotes', function (Blueprint $table) {
            $table->uuid("connote_id")->primary();
            $table->string("location_id");
            $table->integer("connote_number");
            $table->string("connote_service");
            $table->integer("connote_service_price");
            $table->integer("connote_amount");
            $table->string("connote_code");
            $table->string("connote_booking_code");
            $table->integer("connote_order");
            $table->string("connote_state");
            $table->integer("connote_state_id");
            $table->string("zone_code_from");
            $table->string("zone_code_to");
            $table->string("surcharge_amount");
            $table->integer("actual_weight");
            $table->integer("volume_weight");
            $table->integer("chargeable_weight");
            $table->integer("organization_id");
            $table->string("connote_total_package");
            $table->string("connote_surcharge_amount");
            $table->string("connote_sla_day");
            $table->string("location_name");
            $table->string("location_type");
            $table->string("source_tariff_db");
            $table->string("id_source_tariff");
            $table->string("pod");
            $table->array("history");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connotes');
    }
};
