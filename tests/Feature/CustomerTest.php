<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Database\Seeders\AppSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCustomer(): void
    {
        $this->seed(AppSeeder::class);

        $response = $this->post(
            '/api/customers',
            [
                'first_name' => 'Test1',
                'last_name' => 'Test2',
                'email' => 'testing@test.com',
                'password' => 'ThisIsSecretPassword123@'
            ]
        );

        $json = $response->json();

        $customerId = $json['customer_id'];
        $userId = $json['user_id'];

        $response->assertJsonStructure(
            [
                'user_id',
                'customer_id'
            ]
        );

        $this->assertDatabaseHas(
            User::class,
            [
                'id' => $userId,
            ]
        );

        $this->assertDatabaseHas(
            Customer::class,
            [
                'id' => $customerId,
                'user_id' => $userId,
                'first_name' => 'Test1',
                'last_name' => 'Test2',
            ]
        );
    }

    public function testAuth(): void
    {
        $this->seed(AppSeeder::class);

        $response = $this->post(
            '/api/auth',
            [
                'email' => 'user@app.com',
                'password' => 'pass123'
            ]
        );

        $response->assertJsonStructure(
            [
                'token'
            ]
        );
    }

    public function testViewCustomer(): void
    {
        $this->seed(AppSeeder::class);

        Sanctum::actingAs(
            User::query()->find(AppSeeder::USER_ID),
        );

        $response = $this->get(
            '/api/customer',
            [
                'email' => 'user@app.com',
                'password' => 'pass123'
            ]
        );

        $response->assertJsonStructure(
            [
                'id',
                'first_name',
                'last_name',
                'orders'
            ]
        );

        $response->assertJson(
            [
                'id' => AppSeeder::CUSTOMER_ID,
                'first_name' => 'Test',
                'last_name' => 'Testing',
                'orders' => []
            ]
        );
    }
}
