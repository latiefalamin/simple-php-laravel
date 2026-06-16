<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_users_index()
    {
        $response = $this->get('/users');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_users_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/users');

        $response->assertStatus(200);
        $response->assertSee('Daftar Pengguna');
    }

    public function test_guest_cannot_access_edit_page()
    {
        $user = User::factory()->create();

        $response = $this->get('/users/' . $user->id . '/edit');
        
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_edit_page()
    {
        $user = User::factory()->create();
        $targetUser = User::factory()->create();

        $response = $this->actingAs($user)->get('/users/' . $targetUser->id . '/edit');

        $response->assertStatus(200);
        $response->assertSee('Edit Pengguna');
    }

    public function test_user_can_update_data()
    {
        $user = User::factory()->create();
        $targetUser = User::factory()->create([
            'name' => 'Old Name',
            'address' => 'Old Address',
        ]);

        $response = $this->actingAs($user)->put('/users/' . $targetUser->id, [
            'name' => 'New Name',
            'address' => 'New Address',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'name' => 'New Name',
            'address' => 'New Address',
        ]);

        $response->assertRedirect('/users');
        $response->assertSessionHas('success');
    }

    public function test_user_cannot_update_data_with_invalid_input()
    {
        $user = User::factory()->create();
        $targetUser = User::factory()->create([
            'name' => 'Old Name',
        ]);

        $response = $this->actingAs($user)->put('/users/' . $targetUser->id, [
            'name' => '', // empty name is invalid
            'address' => 'New Address',
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'name' => 'Old Name',
        ]);
    }

    public function test_guest_cannot_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->get('/users/' . $user->id . '/delete');

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }

    public function test_user_cannot_delete_themselves()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/users/' . $user->id . '/delete');

        $response->assertRedirect('/users');
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }

    public function test_user_can_delete_other_user()
    {
        $user = User::factory()->create();
        $targetUser = User::factory()->create();

        $response = $this->actingAs($user)->get('/users/' . $targetUser->id . '/delete');

        $response->assertRedirect('/users');
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('users', [
            'id' => $targetUser->id,
        ]);
    }
}
