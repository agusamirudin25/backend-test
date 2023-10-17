<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePutPackageRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|min:3|max:255',
            'customer_code' => 'required|string|min:6|max:10',
            'transaction_amount' => 'required|integer',
            'transaction_discount' => 'required|integer',
            'transaction_additional_field' => 'nullable',
            'transaction_payment_type' => 'required|integer',
            'transaction_state' => 'required|string',
            'transaction_code' => 'required|string',
            'transaction_order' => 'required|integer',
            'location_id' => 'required|string',
            'transaction_payment_type_name' => 'required|string',
            'transaction_cash_amount' => 'required|integer',
            'transaction_cash_change' => 'required|integer',
            'custom_field' => 'nullable',
            'currentLocation' => 'required|array',
            'customer_attribute' => 'required|array',
            'origin_data' => 'required|array',
            'destination_data' => 'required|array',
            'koli_data' => 'required|array',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'    => false,
            'message'   => 'Validation errors',
            'errors'    => $validator->errors()
        ], 422));
    }
}
