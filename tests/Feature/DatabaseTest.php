<?php

namespace Tests\Feature;

use App\Models\Proyect;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_if_model_task_exist(): void
    {
        $task = Task::factory()->for(Proyect::all()->random())->create();

        $this->assertModelExists($task);
    }
}
