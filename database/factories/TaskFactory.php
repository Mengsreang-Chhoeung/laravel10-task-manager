<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'due_date' => $this->faker->optional()->date(),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
        ];
    }
}
