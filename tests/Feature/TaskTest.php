<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_task(): void
    {
        $user = User::factory()->create();

        $data = [
            'title' => 'Test Task',
            'description' => 'Task description',
            'due_date' => '2025-01-01',
            'status' => 'pending',
        ];

        $response = $this->actingAs($user)->post('/tasks', $data);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'user_id' => $user->id,
            'title' => 'Test Task',
        ]);
    }
}
