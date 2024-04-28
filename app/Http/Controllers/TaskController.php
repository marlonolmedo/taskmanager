<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskPostRequest;
use App\Models\Proyect;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allTasks = Task::orderBy("sortpriority")->get();
        return view('viewTask', [
            'allTasks' => $allTasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Proyect::all();
        return view('createTask', [
            'projects' => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskPostRequest $request)
    {
        $task = new Task;
        $data = [
            ...$request->validated(),
            'sortpriority' => Task::max('sortpriority') + 1
        ];
        $task->fill($data);
        $task->save();


        return redirect()->route('createTask')->with('success', 'Task create with sucess.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $projects = Proyect::all();
        return view('editTask', [
            'task' => $task,
            'projects' => $projects
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskPostRequest $request, Task $task)
    {
        $task->fill($request->validated());
        $task->save();

        return redirect()->route('task.edit', ['task' => $task->id])->with('success', 'Task edit with sucess.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('viewTask')->with('success', 'Task delete with sucess.');
    }

    public function changePriority(Task $task, Request $request)
    {
        DB::beginTransaction();
        $lastTask = Task::find($request->fistBoxId);
        if ($request->direction == 'up') { //when goes from bottom to top
            $forChange = Task::whereBetween('sortpriority', [$task->sortpriority, $lastTask->sortpriority])
                ->whereNot('id', $task->id)
                ->orderBy('sortpriority', 'desc')
                ->get();
            $startNumber = $lastTask->sortpriority - 1;
            $task->sortpriority = $lastTask->sortpriority;
            $task->save();
            foreach ($forChange as $key => $eachTask) {
                $eachTask->sortpriority = $startNumber;
                $eachTask->save();
                $startNumber--;
            }
        } else { //when goes from top to bottom
            $forChange = Task::whereBetween('sortpriority', [$lastTask->sortpriority, $task->sortpriority])
                ->whereNotIn('id', [$task->id, $lastTask->id])
                ->orderBy('sortpriority')
                ->get();
            $startNumber = (Task::max('sortpriority') == $lastTask->sortpriority) ? $lastTask->sortpriority : $lastTask->sortpriority + 1;
            $task->sortpriority = $startNumber;
            $task->save();
            foreach ($forChange as $key => $eachTask) {
                $startNumber++;
                $eachTask->sortpriority = $startNumber;
                $eachTask->save();
            }
        }
        try {
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json($th);
        }
        return response()->json([
            'message' => "sort complete",
            'data' => $task
        ]);
    }
}
