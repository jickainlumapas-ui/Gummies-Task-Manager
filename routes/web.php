<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::resource('tasks', TaskController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->name('tasks.updateStatus');
