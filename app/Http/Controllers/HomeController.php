<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    //Authクラスのインポート

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();   // ログインユーザーを取得する
        $folder = $user->folders()->first();// ログインユーザーに紐づくフォルダを一つ取得する

        // 一つもフォルダがなければ、homeへ
        if (is_null($folder)) {
            return view('home');
        }
        // フォルダがある。フォルダのタスク一覧にリダイレクト
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
