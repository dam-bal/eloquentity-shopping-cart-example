<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\User;

class CartPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cart $cart): bool
    {
        return $this->update($user, $cart);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
        //return Customer::query()->where('user_id', '=', $user->id)->first() !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cart $cart): bool
    {
        $customer = Customer::query()->where('user_id', '=', $user->id)->firstOrFail();

        return $cart->customer_id === $customer->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cart $cart): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cart $cart): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cart $cart): bool
    {
        return false;
    }
}
