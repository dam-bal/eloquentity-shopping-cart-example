<?php

namespace App\Http\Requests;

use Core\ShoppingCart\Domain\PaymentMethod;
use Core\ShoppingCart\Domain\Shipment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartCheckoutRequest extends FormRequest
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
            'shipment.full_name' => 'required',
            'payment_method' => ['required', Rule::enum(PaymentMethod::class)],
        ];
    }

    public function shipment(): Shipment
    {
        return new Shipment(
            $this->input('shipment.city'),
            $this->input('shipment.street_name'),
            $this->input('shipment.street_number'),
            $this->input('shipment.full_name')
        );
    }

    public function paymentMethod(): PaymentMethod
    {
        return PaymentMethod::from($this->input('payment_method'));
    }
}
