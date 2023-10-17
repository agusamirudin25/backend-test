<?php

namespace Tests\Feature;

use App\Models\Connote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PackageTest extends TestCase
{
    private $connoteId = '';
    private $transactionId = '';

    public function setUp() : void
    {
        parent::setUp();
        $this->connoteId = Connote::query()->first()->connote_id;
        $this->getTransactionId();
    }

    public function getTransactionId()
    {
        $response = $this->json('get', '/api/v1/packages');
        $this->transactionId = $response->decodeResponseJson()["packages"]["data"]["0"]["transaction_id"];
    }

   
    public function testGetPackages(): void
    {
        $response = $this->json('get', '/api/v1/packages');

        $response
        ->assertStatus(200)
        ->assertSuccessful()
        ->assertJsonPath('status', true);
    }

    public function testGetPackageById()
    {
        $response = $this->json('get', '/api/v1/package/' . $this->transactionId);
        $response
            ->assertStatus(200)
            ->assertSuccessful()
            ->assertJsonPath('status', true)
            ->assertJsonIsArray('data.koli_data')
            ->assertJsonIsObject('data.customer_attribute')
            ->assertJsonIsObject('data.origin_data')
            ->assertJsonIsObject('data.destination_data')
            ->assertJsonPath('data.transaction_id', $this->transactionId);
    }

    public function testGetPackageByIdNotFound()
    {
        $response = $this->json('get', '/api/v1/package/' . '123456');
        $response
            ->assertStatus(404)
            ->assertNotFound()
            ->assertJsonPath('status', false)
            ->assertJsonPath('message', 'Package not exist.');
    }

    public function testPostPackages(): void
    {
        $data = [
            "customer_name" => "PT. AMARA PRIMATIGA",
            "customer_code" => "1678593",
            "transaction_amount" => "70700",
            "transaction_discount" => "20",
            "transaction_additional_field" => "",
            "transaction_payment_type" => "29",
            "transaction_state" => "PAID",
            "transaction_code" => "CGKFT20200715121",
            "transaction_order" => 121,
            "location_id" => "5cecb20b6c49615b174c3e74",
            "organization_id" => 6,
            "transaction_payment_type_name" => "Invoice",
            "transaction_cash_amount" => 0,
            "transaction_cash_change" => 0,
            "customer_attribute" => [
                "Nama_Sales" => "Radit Fitrawikarsa",
                "TOP" => "14 Hari",
                "Jenis_Pelanggan" => "B2B"
            ],
            "connote_id" => $this->connoteId,
            "origin_data" => [
                "customer_name" => "PT. NARA OKA PRAKARSA",
                "customer_address" => "JL. KH. AHMAD DAHLAN NO. 100, SEMARANG TENGAH 12420",
                "customer_email" => "info@naraoka.co.id",
                "customer_phone" => "024-1234567",
                "customer_address_detail" => null,
                "customer_zip_code" => "12420",
                "zone_code" => "CGKFT",
                "organization_id" => 6,
                "location_id" => "5cecb20b6c49615b174c3e74"
            ],
            "destination_data" => [
                "customer_name" => "PT AMARIS HOTEL SIMPANG LIMA",
                "customer_address" => "JL. KH. AHMAD DAHLAN NO. 01, SEMARANG TENGAH",
                "customer_email" => null,
                "customer_phone" => "0248453499",
                "customer_address_detail" => "KOTA SEMARANG SEMARANG TENGAH KARANGKIDUL",
                "customer_zip_code" => "50241",
                "zone_code" => "SMG",
                "organization_id" => 6,
                "location_id" => "5cecb20b6c49615b174c3e74"
            ],
            "koli_data" => [
                [
                    "koli_length" => 0,
                    "awb_url" => "https =>//tracking.mile.app/label/AWB00100209082020.1",
                    "created_at" => "2020-07-15 11 =>11 =>13",
                    "koli_chargeable_weight" => 9,
                    "koli_width" => 0,
                    "koli_surcharge" => [],
                    "koli_height" => 0,
                    "updated_at" => "2020-07-15 11 =>11 =>13",
                    "koli_description" => "V WARP",
                    "koli_formula_id" => null,
                    "connote_id" => $this->connoteId,
                    "koli_volume" => 0,
                    "koli_weight" => 9,
                    "koli_id" => "e2cb6d86-0bb9-409b-a1f0-389ed4f2df2d",
                    "koli_custom_field" => [
                        "awb_sicepat" => null,
                        "harga_barang" => null
                    ],
                    "koli_code" => "AWB00100209082020.1"
                ],
                [
                    "koli_length" => 0,
                    "awb_url" => "https =>//tracking.mile.app/label/AWB00100209082020.2",
                    "created_at" => "2020-07-15 11 =>11 =>13",
                    "koli_chargeable_weight" => 9,
                    "koli_width" => 0,
                    "koli_surcharge" => [],
                    "koli_height" => 0,
                    "updated_at" => "2020-07-15 11 =>11 =>13",
                    "koli_description" => "V WARP",
                    "koli_formula_id" => null,
                    "connote_id" => $this->connoteId,
                    "koli_volume" => 0,
                    "koli_weight" => 9,
                    "koli_id" => "3600f10b-4144-4e58-a024-cc3178e7a709",
                    "koli_custom_field" => [
                        "awb_sicepat" => null,
                        "harga_barang" => null
                    ],
                    "koli_code" => "AWB00100209082020.2"
                ],
                [
                    "koli_length" => 0,
                    "awb_url" => "https =>//tracking.mile.app/label/AWB00100209082020.3",
                    "created_at" => "2020-07-15 11 =>11 =>13",
                    "koli_chargeable_weight" => 2,
                    "koli_width" => 0,
                    "koli_surcharge" => [],
                    "koli_height" => 0,
                    "updated_at" => "2020-07-15 11 =>11 =>13",
                    "koli_description" => "LID HOT CUP",
                    "koli_formula_id" => null,
                    "connote_id" => $this->connoteId,
                    "koli_volume" => 0,
                    "koli_weight" => 2,
                    "koli_id" => "2937bdbf-315e-4c5e-b139-fd39a3dfd15f",
                    "koli_custom_field" => [
                        "awb_sicepat" => null,
                        "harga_barang" => null
                    ],
                    "koli_code" => "AWB00100209082020.3"
                ]
            ],
            "custom_field" => [
                "catatan_tambahan" => "JANGAN DI BANTING / DI TINDIH"
            ],
            "currentLocation" => [
                "name" => "Hub Jakarta Selatan",
                "code" => "JKTS01",
                "type" => "Agent"
            ]
        ];
        $response = $this->json('post', '/api/v1/package', $data);

        $response
        ->assertStatus(201)
        ->assertSuccessful()
        ->assertJsonPath('status', true)
        ->assertJsonPath('data.connote_id', $this->connoteId);
    }
    public function testPostPackagesWithUncompleteForm(): void
    {
        $data = [
            "customer_name" => "PT. AMARA PRIMATIGA",
            "customer_attribute" => [
                "Nama_Sales" => "Radit Fitrawikarsa",
                "TOP" => "14 Hari",
                "Jenis_Pelanggan" => "B2B"
            ],
            "connote_id" => $this->connoteId,
            "origin_data" => [
                "customer_name" => "PT. NARA OKA PRAKARSA",
                "customer_address" => "JL. KH. AHMAD DAHLAN NO. 100, SEMARANG TENGAH 12420",
                "customer_email" => "info@naraoka.co.id",
                "customer_phone" => "024-1234567",
                "customer_address_detail" => null,
                "customer_zip_code" => "12420",
                "zone_code" => "CGKFT",
                "organization_id" => 6,
                "location_id" => "5cecb20b6c49615b174c3e74"
            ],
            "destination_data" => [
                "customer_name" => "PT AMARIS HOTEL SIMPANG LIMA",
                "customer_address" => "JL. KH. AHMAD DAHLAN NO. 01, SEMARANG TENGAH",
                "customer_email" => null,
                "customer_phone" => "0248453499",
                "customer_address_detail" => "KOTA SEMARANG SEMARANG TENGAH KARANGKIDUL",
                "customer_zip_code" => "50241",
                "zone_code" => "SMG",
                "organization_id" => 6,
                "location_id" => "5cecb20b6c49615b174c3e74"
            ],
            "koli_data" => [
                [
                    "koli_length" => 0,
                    "awb_url" => "https =>//tracking.mile.app/label/AWB00100209082020.1",
                    "created_at" => "2020-07-15 11 =>11 =>13",
                    "koli_chargeable_weight" => 9,
                    "koli_width" => 0,
                    "koli_surcharge" => [],
                    "koli_height" => 0,
                    "updated_at" => "2020-07-15 11 =>11 =>13",
                    "koli_description" => "V WARP",
                    "koli_formula_id" => null,
                    "connote_id" => $this->connoteId,
                    "koli_volume" => 0,
                    "koli_weight" => 9,
                    "koli_id" => "e2cb6d86-0bb9-409b-a1f0-389ed4f2df2d",
                    "koli_custom_field" => [
                        "awb_sicepat" => null,
                        "harga_barang" => null
                    ],
                    "koli_code" => "AWB00100209082020.1"
                ],
            ],
        ];
        $response = $this->json('post', '/api/v1/package', $data);

        $response
        ->assertStatus(422)
        ->assertJsonPath('status', false);
    }
    public function testUpdatePackages(): void
    {
        $data = [
            "customer_name" => "PT. AMARA",
            "customer_code" => "1678593",
            "transaction_amount" => "70700",
            "transaction_discount" => "20",
            "transaction_additional_field" => "",
            "transaction_payment_type" => "29",
            "transaction_state" => "PAID",
            "transaction_code" => "CGKFT20200715121",
            "transaction_order" => 121,
            "location_id" => "5cecb20b6c49615b174c3e74",
            "organization_id" => 6,
            "transaction_payment_type_name" => "Invoice",
            "transaction_cash_amount" => 0,
            "transaction_cash_change" => 0,
            "customer_attribute" => [
                "Nama_Sales" => "Radit Fitrawikarsa",
                "TOP" => "14 Hari",
                "Jenis_Pelanggan" => "B2B"
            ],
            "origin_data" => [
                "customer_name" => "PT. NARA OKA PRAKARSA",
                "customer_address" => "JL. KH. AHMAD DAHLAN NO. 100, SEMARANG TENGAH 12420",
                "customer_email" => "info@naraoka.co.id",
                "customer_phone" => "024-1234567",
                "customer_address_detail" => null,
                "customer_zip_code" => "12420",
                "zone_code" => "CGKFT",
                "organization_id" => 6,
                "location_id" => "5cecb20b6c49615b174c3e74"
            ],
            "destination_data" => [
                "customer_name" => "PT AMARIS HOTEL SIMPANG LIMA",
                "customer_address" => "JL. KH. AHMAD DAHLAN NO. 01, SEMARANG TENGAH",
                "customer_email" => null,
                "customer_phone" => "0248453499",
                "customer_address_detail" => "KOTA SEMARANG SEMARANG TENGAH KARANGKIDUL",
                "customer_zip_code" => "50241",
                "zone_code" => "SMG",
                "organization_id" => 6,
                "location_id" => "5cecb20b6c49615b174c3e74"
            ],
            "koli_data" => [
                [
                    "koli_length" => 0,
                    "awb_url" => "https =>//tracking.mile.app/label/AWB00100209082020.1",
                    "created_at" => "2020-07-15 11 =>11 =>13",
                    "koli_chargeable_weight" => 9,
                    "koli_width" => 0,
                    "koli_surcharge" => [],
                    "koli_height" => 0,
                    "updated_at" => "2020-07-15 11 =>11 =>13",
                    "koli_description" => "V WARP",
                    "koli_formula_id" => null,
                    "connote_id" => $this->connoteId,
                    "koli_volume" => 0,
                    "koli_weight" => 9,
                    "koli_id" => "e2cb6d86-0bb9-409b-a1f0-389ed4f2df2d",
                    "koli_custom_field" => [
                        "awb_sicepat" => null,
                        "harga_barang" => null
                    ],
                    "koli_code" => "AWB00100209082020.1"
                ],
                [
                    "koli_length" => 0,
                    "awb_url" => "https =>//tracking.mile.app/label/AWB00100209082020.2",
                    "created_at" => "2020-07-15 11 =>11 =>13",
                    "koli_chargeable_weight" => 9,
                    "koli_width" => 0,
                    "koli_surcharge" => [],
                    "koli_height" => 0,
                    "updated_at" => "2020-07-15 11 =>11 =>13",
                    "koli_description" => "V WARP",
                    "koli_formula_id" => null,
                    "connote_id" => $this->connoteId,
                    "koli_volume" => 0,
                    "koli_weight" => 9,
                    "koli_id" => "3600f10b-4144-4e58-a024-cc3178e7a709",
                    "koli_custom_field" => [
                        "awb_sicepat" => null,
                        "harga_barang" => null
                    ],
                    "koli_code" => "AWB00100209082020.2"
                ],
                [
                    "koli_length" => 0,
                    "awb_url" => "https =>//tracking.mile.app/label/AWB00100209082020.3",
                    "created_at" => "2020-07-15 11 =>11 =>13",
                    "koli_chargeable_weight" => 2,
                    "koli_width" => 0,
                    "koli_surcharge" => [],
                    "koli_height" => 0,
                    "updated_at" => "2020-07-15 11 =>11 =>13",
                    "koli_description" => "LID HOT CUP",
                    "koli_formula_id" => null,
                    "connote_id" => $this->connoteId,
                    "koli_volume" => 0,
                    "koli_weight" => 2,
                    "koli_id" => "2937bdbf-315e-4c5e-b139-fd39a3dfd15f",
                    "koli_custom_field" => [
                        "awb_sicepat" => null,
                        "harga_barang" => null
                    ],
                    "koli_code" => "AWB00100209082020.3"
                ]
            ],
            "custom_field" => [
                "catatan_tambahan" => "JANGAN DI BANTING / DI TINDIH"
            ],
            "currentLocation" => [
                "name" => "Hub Jakarta Selatan",
                "code" => "JKTS01",
                "type" => "Agent"
            ]
        ];
        $response = $this->json('put', '/api/v1/package/' . $this->transactionId, $data);

        $response
        ->assertStatus(200)
        ->assertSuccessful()
        ->assertJsonPath('status', true)
        ->assertJsonPath('data.connote_id', $this->connoteId);
    }
    public function testUpdatePatchPackages(): void
    {
        $data = [
            "customer_name" => "PT. AMARA PUTRI",
            "customer_code" => "1678522",
            "transaction_amount" => "10000"
        ];
        $response = $this->json('patch', '/api/v1/package/' . $this->transactionId, $data);

        $response
        ->assertStatus(200)
        ->assertSuccessful()
        ->assertJsonPath('status', true)
        ->assertJsonPath('data.connote_id', $this->connoteId);
    }

    public function testDeletePackage(): void
    {
        $response = $this->json('delete', '/api/v1/package/' . $this->transactionId);

        $response
        ->assertStatus(200)
        ->assertSuccessful()
        ->assertJsonPath('status', true);
    }

    public function testDeletePackageNotFound(): void
    {
        $response = $this->json('delete', '/api/v1/package/' . '123456');

        $response
        ->assertStatus(404)
        ->assertNotFound()
        ->assertJsonPath('message', 'Package not exist.')
        ->assertJsonPath('status', false);
    }
}
