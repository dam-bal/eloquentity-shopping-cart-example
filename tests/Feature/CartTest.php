<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\User;
use Database\Seeders\AppSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatesCart(): void
    {
        $this->seed(AppSeeder::class);

        Sanctum::actingAs(User::query()->find(AppSeeder::USER_ID));

        $response = $this->post(
            '/api/carts',
            [
                'customer_id' => AppSeeder::CUSTOMER_ID,
            ]
        );

        $json = $response->json();

        $cartId = $json['cart_id'];

        $this->assertDatabaseHas(
            Cart::class,
            [
                'id' => $cartId,
                'customer_id' => AppSeeder::CUSTOMER_ID,
                'completed' => false,
            ]
        );

        $response->assertStatus(201);
    }

    public function testReturnsCart(): void
    {
        $this->seed(AppSeeder::class);

        Sanctum::actingAs(User::query()->find(AppSeeder::USER_ID));

        $response = $this->get('/api/carts/' . AppSeeder::CART_ID);

        $response->assertJsonStructure(
            [
                'customer_id',
                'items' => [
                    '*' => [
                        'product_id',
                        'quantity'
                    ]
                ]
            ]
        );

        $response->assertStatus(200);
    }

    public function testAddingProductToCart(): void
    {
        $this->seed(AppSeeder::class);

        Sanctum::actingAs(User::query()->find(AppSeeder::USER_ID));

        $response = $this->post('/api/carts/' . AppSeeder::CART_ID . '/items/' . AppSeeder::PRODUCT_ID);

        $this->assertDatabaseHas(
            CartItem::class,
            [
                'product_id' => AppSeeder::PRODUCT_ID,
                'cart_id' => AppSeeder::CART_ID,
                'quantity' => 3,
            ]
        );

        $response->assertStatus(201);
    }

    public function testRemovingProductFromCart(): void
    {
        $this->seed(AppSeeder::class);

        Sanctum::actingAs(User::query()->find(AppSeeder::USER_ID));

        $response = $this->delete('/api/carts/' . AppSeeder::CART_ID . '/items/' . AppSeeder::PRODUCT_ID);

        $this->assertDatabaseHas(
            CartItem::class,
            [
                'product_id' => AppSeeder::PRODUCT_ID,
                'cart_id' => AppSeeder::CART_ID,
                'quantity' => 1,
            ]
        );

        $response->assertStatus(200);
    }

    public function testCheckout(): void
    {
        $this->seed(AppSeeder::class);

        Sanctum::actingAs(User::query()->find(AppSeeder::USER_ID));

        $response = $this->post(
            '/api/carts/' . AppSeeder::CART_ID . '/checkout',
            [
                'shipment' => [
                    'city' => 'City',
                    'street_name' => 'Street',
                    'street_number' => '1',
                    'receiver_full_name' => 'Test Test'
                ],
                'payment_method' => 'card',
            ]
        );

        $orderId = $response->json('order_id');

        $this->assertDatabaseHas(
            Cart::class,
            [
                'id' => AppSeeder::CART_ID,
                'completed' => true,
            ]
        );

        $this->assertDatabaseHas(
            Order::class,
            [
                'id' => $orderId,
                'status' => 'placed',
            ]
        );

        $this->assertDatabaseHas(
            OrderLine::class,
            [
                'order_id' => $orderId,
            ]
        );
    }
}
