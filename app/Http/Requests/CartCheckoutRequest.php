<?php

namespace App\Http\Requests;

use Core\ShoppingCart\Domain\PaymentMethod;
use Illuminate\Validation\Rule;

class CartCheckoutRequest extends BaseRequest
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
            'shipment.city' => 'required|min:3',
            'shipment.street_name' => 'required|min:3',
            'shipment.street_number' => 'required|min:1',
            'shipment.receiver_full_name' => 'required',
            'payment_method' => ['required', Rule::enum(PaymentMethod::class)],
        ];
    }
}
