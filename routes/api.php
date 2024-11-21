<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;



Route::apiResource('tasks', TaskController::class);
Route::get('user-tasks/{email}', [TaskController::class, 'userTasks'])
    ->name('tasks.user-tasks');


Route::get('notifications', [NotificationController::class, 'index'])
    ->name('notifications.index');
Route::post('notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])
    ->name('notifications.mark-as-read');
Route::post('notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])
    ->name('notifications.mark-all-as-read');
