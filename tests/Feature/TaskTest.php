<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
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

    public function test_authenticated_user_can_update_task(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->for($user)->create(['title' => 'Old Title']);

        $response = $this->actingAs($user)->put("/tasks/{$task->id}", [
            'title' => 'Updated Title',
            'description' => $task->description,
            'due_date' => $task->due_date?->format('Y-m-d'),
            'status' => 'completed',
        ]);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Title',
            'status' => 'completed',
        ]);
    }

    public function test_authenticated_user_can_delete_task(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->for($user)->create();

        $response = $this->actingAs($user)->delete("/tasks/{$task->id}");

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_user_cannot_modify_other_users_task(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $task = Task::factory()->for($other)->create();

        $response = $this->actingAs($user)->put("/tasks/{$task->id}", [
            'title' => 'Fail',
            'status' => 'pending',
        ]);

        $response->assertStatus(403);
    }
}
