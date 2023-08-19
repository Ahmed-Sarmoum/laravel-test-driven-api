<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

Route::get('todo-list', [TodoListController::class, 'index'])->name('todo-list.fetch');
Route::get('todo-list/{todo}', [TodoListController::class, 'show'])->name('todo-list.show');

Route::post('todo-list', [TodoListController::class, 'store'])->name('todo-list.store');
