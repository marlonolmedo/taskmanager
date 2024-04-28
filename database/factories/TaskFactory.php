<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $taskMax = Task::max('sortpriority');
        return [
            'name' => fake()->sentence(3, true),
            'priority' => collect(['medium', 'low'])->random(),
            'description' => fake()->paragraph(),
            'sortpriority' => $taskMax === null ? 1 : $taskMax + 1
        ];
    }
}
