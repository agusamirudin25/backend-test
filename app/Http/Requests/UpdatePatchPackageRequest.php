<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePatchPackageRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'nullable|string|min:3|max:255',
            'customer_code' => 'nullable|string|min:6|max:10',
            'transaction_amount' => 'nullable|integer',
            'transaction_discount' => 'nullable|integer',
            'transaction_additional_field' => 'nullable',
            'transaction_payment_type' => 'nullable|integer',
            'transaction_state' => 'nullable|string',
            'transaction_code' => 'nullable|string',
            'transaction_order' => 'nullable|integer',
            'location_id' => 'nullable|string',
            'transaction_payment_type_name' => 'nullable|string',
            'transaction_cash_amount' => 'nullable|integer',
            'transaction_cash_change' => 'nullable|integer',
            'custom_field' => 'nullable',
            'currentLocation' => 'nullable|array',
            'customer_attribute' => 'nullable|array',
            'origin_data' => 'nullable|array',
            'destination_data' => 'nullable|array',
            'koli_data' => 'nullable|array',
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
