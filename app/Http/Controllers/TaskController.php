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
    /**
     * タスク一覧
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function index(Folder $folder)
    {
        if (Auth::user()->id !== $folder->user_id) {
            abort(403);
        }
        $folders = Auth::user()->folders()->get();  // ユーザのフォルダを取得

        $tasks = $folders->tasks()->get();    // 選択したフォルダに紐づくタスク取得
        // $tasks = Tasks::where('folder_id', $current_folder->id)->get();

        return view('tasks.index', [
            'folders' => $folders,
            'current_folder_id' => $folder->$id,
            'tasks' => $tasks,
        ]);
    }

    /**
     * タスク作成フォーム
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function showCreateForm(Folder $folder)
    {
        return view('tasks.create', [
            'folder_id' => $folder->id
        ]);
    }

    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task(); // Taskモデルのインスタンス作成
        $task->title = $request->title; // title入力値
        $task->due_date = $request->due_date;// due_date入力値

        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder, Task $task)
    {
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();  //編集対象のTask、入力値をセット→DBへsave

        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}
