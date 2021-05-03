<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    //Authクラスのインポート
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Models\Folder;
use App\Models\Task;

class TaskController extends Controller
{
    // タスク一覧
    public function index(int $id)
    {
        $folders = Folder::all();// すべてのFolderを取得
        $current_folder = Folder::find($id);// 選ばれたフォルダを取得する

        if (Auth::user()->id !== $current_folder->user_id) {
            abort(403);
        }

        $folders = Auth::user()->folders()->get();  // ユーザのフォルダを取得
        $tasks = $current_folder->tasks()->get();    // 選択したフォルダに紐づくタスク取得

        return view('tasks.index', [
            'folders' => $folders,
            'current_folder' => $current_folder,
            'tasks' => $tasks,
        ]);
    }

    // タスク作成フォーム
    public function showCreateForm(int $id)
    {
        return view('tasks.create', [
            'folder_id' => $id
        ]);
    }

    // タスク作成
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

    // タスク編集フォーム
    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
        $task = Task::find($task_id);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();  //編集対象のTask、入力値をセット→DBへsave

        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}
