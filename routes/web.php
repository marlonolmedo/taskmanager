<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'task');

Route::resource('task', TaskController::class)->names([
    'index' => 'viewTask',
    'create' => 'createTask'
]);
