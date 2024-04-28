<?php

namespace Tests\Feature;

use App\Models\Proyect;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_view_task_page(): void
    {
        $response = $this->get('/task');

        $response->assertStatus(200);
    }

    public function test_create_task_page(): void
    {
        $response = $this->get('/task/create');

        $response->assertStatus(200);
    }

    public function test_edit_task_page(): void
    {
        $oneTask = Task::limit(5)->get()->random();

        $response = $this->get("/task/" . $oneTask->id . "/edit");

        $response->assertStatus(200);
    }

    public function test_can_create_task_from_webpage(): void
    {
        $response = $this->post("/task", [
            'name' => 'my task test',
            'priority' => 'low',
            'proyect_id' => 1,
            'description' => 'lorem ipsu',
            // "_token" => csrf_token()
        ]);

        $response->assertRedirect('/task/create');
    }

    public function test_can_update_task(): void
    {
        $task = Task::factory()->for(Proyect::factory()->create())->create();

        $response = $this->put("/task/" . $task->id, [
            'name' => 'my task test',
            'priority' => 'low',
            'proyect_id' => 1,
            'description' => 'lorem ipsu',
        ]);

        $response->assertRedirect("/task/" . $task->id . "/edit");
    }

    public function test_error_name_priority_create(): void
    {
        $response = $this->post("/task", [
            'priority' => 'low',
            'proyect_id' => 1,
            // 'description' => 'lorem ipsu',
            // "_token" => csrf_token()
        ]);

        $response->assertSessionHasErrors(['name', 'description']);
    }

    public function test_sorting_task_works_dow_to_up(): void
    {
        $fistTask = Task::orderBy('sortpriority')->first();
        $lastTask = Task::orderBy('sortpriority', 'desc')->first();

        $response = $this->post('api/changepriority/' . $lastTask->id, [
            "fistBoxId" => $fistTask->id,
            "direction" => 'up'
        ]);

        $response->assertJsonPath(
            'data.sortpriority',
            $fistTask->sortpriority
        );
    }

    public function test_sorting_task_works_up_to_down(): void
    {
        $fistTask = Task::orderBy('sortpriority')->first();
        $lastTask = Task::orderBy('sortpriority', 'desc')->first();

        // dd(
        //     $fistTask, $lastTask
        // );

        $response = $this->post('api/changepriority/' . $fistTask->id, [
            "fistBoxId" => $lastTask->id,
            "direction" => 'down'
        ]);

        $response->assertJsonPath(
            'data.sortpriority',
            $lastTask->sortpriority
        );
    }

    public function test_can_delete_task(): void
    {
        $oneTask = Task::limit(5)->get()->random();

        $response = $this->delete("/task/" . $oneTask->id);

        // $response->dumpHeaders();

        // $response->assertStatus(200);
        $response->assertRedirect('/task');
    }
}
