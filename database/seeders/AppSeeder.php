<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product1 = new Product();

        $product1->name = "Product 1";
        $product1->sku = "PRODUCT-1";
        $product1->price = 15.0;

        $product1->save();

        $product2 = new Product();

        $product2->name = "Product 1";
        $product2->sku = "PRODUCT-1";
        $product2->price = 15.0;

        $product2->save();

        $user = new User();

        $user->name = "User";
        $user->email = "user@app.com";
        $user->password = Hash::make('pass123');

        $user->save();

        $customer = new Customer();

        $customer->firstName = "Test";
        $customer->lastName = "Testing";
        $customer->userId = $user->id;

        $customer->save();
    }
}
