<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth機能のルーティング
Auth::routes();
// ホーム画面
Route::get('/home', [HomeController::class, 'index'])->name('home');
// タスク一覧ページ
Route::get('/folders/{id}/tasks', [TaskController::class, 'index'])->name('tasks.index');
// フォルダ
Route::get('/folders/create', [FolderController::class, 'showCreateForm'])->name('folders.create');
Route::post('/folders/create', [FolderController::class, 'create']);
// タスク追加
Route::get('/folders/{id}/tasks/create', [TaskController::class, 'showCreateForm'])->name('tasks.create');
Route::post('/folders/{id}/tasks/create', [TaskController::class, 'create']);
// タスク編集
Route::get('/folders/{id}/tasks/{task_id}/edit', [TaskController::class, 'showEditForm'])->name('tasks.edit');
Route::post('/folders/{id}/tasks/{task_id}/edit', [TaskController::class, 'edit']);
