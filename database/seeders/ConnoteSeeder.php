<?php

namespace Database\Seeders;

use App\Models\Connote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConnoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Connote::truncate();
        $data = [
            "connote_number" => 1,
            "connote_service" => "ECO",
            "connote_service_price" => 70700,
            "connote_amount" => 70700,
            "connote_code" => "AWB00100209082020",
            "connote_booking_code" => "",
            "connote_order" => 326931,
            "connote_state" => "PAID",
            "connote_state_id" => 2,
            "zone_code_from" => "CGKFT",
            "zone_code_to" => "SMG",
            "surcharge_amount" => null,
            "actual_weight" => 20,
            "volume_weight" => 0,
            "chargeable_weight" => 20,
            "organization_id" => 6,
            "location_id" => "5cecb20b6c49615b174c3e74",
            "connote_total_package" => "3",
            "connote_surcharge_amount" => "0",
            "connote_sla_day" => "4",
            "location_name" => "Hub Jakarta Selatan",
            "location_type" => "HUB",
            "source_tariff_db" => "tariff_customers",
            "id_source_tariff" => "1576868",
            "pod" => null,
            "history" => []
        ];
        Connote::create($data);
    }
}
