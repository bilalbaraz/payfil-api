<?php

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use MarvinLabs\Luhn\Rules\LuhnRule;

class OrderCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_provider_id' => 'required|exists:payment_providers,id',
            'product_id' => 'required|exists:products,id',
            'expire_month' => 'required|integer|between:1,12',
            'expire_year' => 'required|integer|digits:4',
            'card_number' => [
                'required',
                'numeric',
                'digits_between:13,19',
                new LuhnRule(),
            ],
            'card_holdername' => 'required',
            'cvc' => 'required',
            'installment' => 'required|in:1,2,3,6,9,12',
            'shipping_address' => 'required',
            'billing_address' => 'required',
            'quantity' => 'required|min:1',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'success' => false,
                    'data' => $validator->errors(),
                ],
                400
            )
        );
    }
}
