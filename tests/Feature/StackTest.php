<?php

namespace Tests\Feature;

use App\Models\Stack;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class StackTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_to_stack()
    {
        $response = $this->postJson('/api/stack/add', ['value' => 'Hello']);
        $response->assertStatus(200);
        $this->assertDatabaseHas('stacks', ['value' => 'Hello']);
    }

    public function test_get_from_stack()
    {
        Stack::factory()->create(['value' => 'World']);
        $response = $this->getJson('/api/stack/get');
        $response->assertStatus(200)->assertJson(['value' => 'World']);
        $this->assertDatabaseMissing('stacks', ['value' => 'World']);
    }
}
