<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Str;

const FIELD = [
    'transaction_id',
    'customer_name',
    'customer_code',
    'transaction_amount',
    'transaction_amount',
    'transaction_discount',
    'transaction_additional_field',
    'transaction_payment_type',
    'transaction_state',
    'transaction_code',
    'transaction_order',
    'location_id',
    'organization_id',
    'transaction_payment_type_name',
    'transaction_cash_amount',
    'transaction_cash_change',
    'customer_attribute',
    'connote_id',
    'origin_data',
    'destination_data',
    'koli_data',
    'custom_field',
    'currentLocation'
];

class Package extends Model
{
    use HasFactory;

    protected $primaryKey = "transaction_id";

    public static $attribute = FIELD;

    protected $fillable = FIELD;

    protected $cast = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function connote() {
        return $this->hasOne(Connote::class, 'connote_id', 'connote_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->transaction_id = Str::uuid()->toString();
        });
    }
}
