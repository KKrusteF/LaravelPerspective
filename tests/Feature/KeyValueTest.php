<?php

namespace Tests\Feature;

use App\Models\KeyValueStore;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class KeyValueTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_key_value()
    {
        $response = $this->postJson('/api/key-value/add', ['key' => 'name', 'value' => 'John']);
        $response->assertStatus(201);
        $this->assertDatabaseHas('key_value_stores', ['key' => 'name', 'value' => 'John']);
    }

    public function test_get_key_value()
    {
        $kv = KeyValueStore::factory()->create(['key' => 'name', 'value' => 'John']);
        $response = $this->getJson('/api/key-value/get/name');
        $response->assertStatus(200)->assertJson(['value' => 'John']);
    }

    public function test_get_key_value_with_ttl()
    {
        KeyValueStore::factory()->withTTL(30)->create(['key' => 'name', 'value' => 'Larry']);
        $response = $this->getJson('/api/key-value/get/name');
        $response->assertStatus(200)->assertJson(['value' => 'Larry']);

        Carbon::setTestNow(Carbon::now()->addSeconds(31));
        $response = $this->getJson('/api/key-value/get/name');
        $response->assertStatus(404);
    }

    public function test_delete_key_value()
    {
        KeyValueStore::factory()->create(['key' => 'name', 'value' => 'John']);
        $response = $this->deleteJson('/api/key-value/delete/name');
        $response->assertStatus(200);
        $this->assertDatabaseMissing('key_value_stores', ['key' => 'name']);
    }
}
