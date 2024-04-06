<?php

namespace App\Http\Requests;

use Core\ShoppingCart\Domain\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreCustomerRequest extends FormRequest
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
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|unique:users|email',
            'password' => ['required', Password::min(6)->numbers()->letters()->mixedCase()->symbols()]
        ];
    }

    public function customer(): Customer
    {
        return new Customer($this->input('first_name'), $this->input('last_name'));
    }
}
