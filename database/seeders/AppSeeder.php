<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AppSeeder extends Seeder
{
    public const CUSTOMER_ID = '9c5394f7-8322-44c9-807c-9de75417da74';
    public const CART_ID = 'a1a5dc2a-e236-4e2d-863f-2562906bf206';
    public const PRODUCT_ID = '2e95b370-a936-4787-a634-c8fea1894357';
    public const USER_ID = 1;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product1 = new Product();

        $product1->id = self::PRODUCT_ID;
        $product1->name = "Product 1";
        $product1->sku = "PRODUCT-1";
        $product1->price = 15.0;

        $product1->save();

        $product2 = new Product();

        $product2->name = "Product 2";
        $product2->sku = "PRODUCT-2";
        $product2->price = 100.0;

        $product2->save();

        $user = new User();

        $user->id = self::USER_ID;
        $user->name = "User";
        $user->email = "user@app.com";
        $user->password = Hash::make('pass123');

        $user->save();

        $customer = new Customer();

        $customer->id = self::CUSTOMER_ID;
        $customer->first_name = "Test";
        $customer->last_name = "Testing";
        $customer->user_id = $user->id;

        $customer->save();

        $cart = new Cart();

        $cart->id = self::CART_ID;
        $cart->customer_id = $customer->id;

        $cart->save();

        $cartItem1 = new CartItem();

        $cartItem1->cart_id = $cart->id;
        $cartItem1->product_id = $product1->id;
        $cartItem1->quantity = 2;

        $cartItem1->save();

        $cartItem2 = new CartItem();

        $cartItem2->cart_id = $cart->id;
        $cartItem2->product_id = $product2->id;
        $cartItem2->quantity = 1;

        $cartItem2->save();
    }
}
