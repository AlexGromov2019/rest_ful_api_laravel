<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{

    public function test_models_items()
    {
        $items = Item::factory()->count(10)->create();
        $this->expectNotToPerformAssertions();
    }

    public function test_making_an_api_request_get_all_items()
    {
        $response = $this->getJson('/api/items');
        $response->assertStatus(200);
    }

    public function test_making_an_api_request_get_one_item()
    {
        $response = $this->getJson('/api/items/22');
        $response->assertStatus(200);
    }

    public function test_making_an_api_request_post_create_item()
    {
        $response = $this->postJson('/api/items',
            ['name' => 'Sally', 'key' => 's5hh374tY18D']);
        $response->assertStatus(201);
    }

    public function test_making_an_api_request_put_update_item()
    {
        $response = $this->putJson('/api/items/23',
            ['name' => 'New Name3', 'key' => '2222222222']
        );
        $response->assertStatus(200);
    }

    public function test_making_an_api_request_delete_item()
    {
        $response = $this->deleteJson('/api/items/25');
        $response->assertStatus(204);
    }
}
