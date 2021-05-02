<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(int $id)
    {
        $folders = Folder::all();                   //Folder全レコード取得
        $current_folder = Folder::find($id);        // 選択したフォルダ取得

        $tasks = $current_folder->tasks()->get();    // 選択したフォルダに紐づくタスク取得
        // $tasks = Tasks::where('folder_id', $current_folder->id)->get();

        return view('tasks.index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->$id,
            'tasks' => $tasks,
        ]);
    }
}
