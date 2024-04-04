<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $user = new User();
        $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $customer = new Customer();
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->user_id = $user->id;
        $customer->save();

        return new JsonResponse(['user_id' => $user->id, 'customer_id' => $customer->id], 201);
    }

    public function auth(AuthRequest $request)
    {
        /** @var User $user */
        $user = User::query()->where('email', '=', $request->input('email'))->first();

        if (!$user) {
            throw new \InvalidArgumentException("Could not auth");
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            throw new \InvalidArgumentException("Could not auth");
        }

        return ['token' => $user->createToken('api')->plainTextToken];
    }

    public function show(Request $request)
    {
        $user = $request->user();

        $customer = Customer::query()->where('user_id', '=', $user->id)->with('orders')->first();

        if (!$customer) {
            throw new \InvalidArgumentException();
        }

        return [
            'id' => $customer->id,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'orders' => $customer->orders,
        ];
    }
}
