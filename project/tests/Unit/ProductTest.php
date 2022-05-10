<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private $apiEndpoint = '/api/products';
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateProductWithoutAuthentication()
    {
        $data = [
            'name' => "New Product",
            'price' => 99.99,
            'code' => 'NP',
            'quantity' => 423
        ];

        $response = $this->postJson($this->apiEndpoint, $data);
        $response->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
    }

    public function testCreateProduct()
    {
        $data = [
            'name' => "New Product",
            'price' => 99.99,
            'code' => 'NP',
            'quantity' => 423
        ];

        $response = $this->createProduct($data);

        $response->assertStatus(201);
        $response->assertJson(['message' => "New product created"]);
        $response->assertJson(['data' => $data]);
    }

    public function testGetAllProducts()
    {
        $response = $this->getJson($this->apiEndpoint);
        $response->assertStatus(200);        

        $response->assertJsonStructure([
            'message',
            'statusCode',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'price',
                    'code',
                    'quantity',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);
    }

    public function testUpdateProduct()
    {
        $data = [
            'name' => "New Product",
            'price' => 99.99,
            'code' => 'NP',
            'quantity' => 423
        ];

        $response = $this->createProduct($data);

        $response = $this->getJson($this->apiEndpoint);
        $response->assertStatus(200);

        $product = $response->getData()->data[0];

        $data = [
            'name' => "Rename product",
        ];

        $user = User::factory()->create();
        $update = $this->actingAs($user)->putJson('/api/products/'.$product->id, $data);
        $update->assertStatus(200);
        $update->assertJson(['message' => "Product updated"]);
        $update->assertJson(['data' => $data]);
    }

    public function testDeleteProduct()
    {
        $data = [
            'name' => "New Product",
            'price' => 99.99,
            'code' => 'NP',
            'quantity' => 423
        ];

        $response = $this->createProduct($data);

        $response = $this->getJson($this->apiEndpoint);
        $response->assertStatus(200);

        $product = $response->getData()->data[0];

        $user = User::factory()->create();
        $delete = $this->actingAs($user)->deleteJson('/api/products/'.$product->id);
        $delete->assertStatus(200);
        $delete->assertJson(['message' => "Product deleted"]);
    }

    private function createProduct($data)
    {
        $user = User::factory()->create();
        return $this->actingAs($user)->postJson($this->apiEndpoint, $data);
    }
}
