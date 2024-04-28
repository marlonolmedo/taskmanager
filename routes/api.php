<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('changepriority/{task}', [TaskController::class, 'changePriority'])->name('changepriority');
