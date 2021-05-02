<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    //Authクラスのインポート
use App\Http\Requests\CreateFolder;
use App\Models\Folder;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders.create');
    }

    public function create(CreateFolder $request)
    {
        $folder = new Folder(); // Folderモデルのインスタンス作成
        $folder->title = $request->title;   // title入力値
        Auth::user()->folders()->save($folder); // ユーザ紐付けて、DBへ書き込み

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
