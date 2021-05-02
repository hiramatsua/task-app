<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    //Authクラスのインポート
use App\Http\Requests\CreateTask;
use App\Models\Folder;
use App\Models\Task;


class TaskController extends Controller
{
    public function index(int $id)
    {
        $folders = Auth::user()->folders()->get();  // ユーザのフォルダを取得
        $current_folder = Folder::find($id);        // 選択したフォルダ取得

        $tasks = $current_folder->tasks()->get();    // 選択したフォルダに紐づくタスク取得
        // $tasks = Tasks::where('folder_id', $current_folder->id)->get();

        return view('tasks.index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->$id,
            'tasks' => $tasks,
        ]);
    }

    // GET /folders/{id}/tasks/create
    public function showCreateForm(int $id)
    {
        return view('tasks.create', [
            'folder_id' => $id
        ]);
    }

    // POST /folders/{id}/tasks/create
    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task(); // Taskモデルのインスタンス作成
        $task->title = $request->title; // title入力値
        $task->due_date = $request->due_date;// due_date入力値

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }
}
