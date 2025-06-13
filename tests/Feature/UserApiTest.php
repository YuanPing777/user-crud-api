<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_users()
    {
        User::factory()->count(5)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'responseCode', 'msgType', 'message', 'data' => ['data']
                 ]);
    }

    public function test_filters_users_by_status()
    {
        User::factory()->create(['status' => 'active']);
        User::factory()->create(['status' => 'inactive']);

        $response = $this->getJson('/api/users?status=active');

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'active'])
                 ->assertJsonMissing(['status' => 'inactive']);
    }

    public function test_creates_a_user()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone_number' => '1234567890',
            'password' => 'secret123',
            'status' => 'active'
        ];

        $response = $this->postJson('/api/users', $payload);

        $response->assertStatus(200)
                 ->assertJsonFragment(['email' => 'john@example.com']);

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    public function test_shows_a_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['email' => $user->email]);
    }

    public function test_returns_not_found_for_invalid_user()
    {
        $response = $this->getJson('/api/users/999');

        $response->assertStatus(200)
                 ->assertJsonFragment(['msgType' => 'error']);
    }

    public function test_deletes_a_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(200)
                ->assertJsonPath('data.id', (string) $user->id);

        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    public function test_bulk_deletes_users()
    {
        $users = User::factory()->count(3)->create();
        $ids = $users->pluck('id')->toArray();

        $response = $this->postJson('/api/users/bulk-delete', ['ids' => $ids]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['ids' => $ids]);

        foreach ($ids as $id) {
            $this->assertSoftDeleted('users', ['id' => $id]);
        }
    }
}
