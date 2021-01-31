<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{   
    public function index()
    {
        // ログインユーザーを取得
        $user = Auth::user();

        // ログインユーザーに紐づくフォルダを一つ取得
        $folder = $user->folders()->first();

        // もしまだ一つもフォルダ作成されていなければ、ホームページへレスポンス
        if (is_null($folder)) {
            return view('home');
        }

        // フォルダが一つでも作成されていれば、そのフォルダのタスク一覧にリダイレクト
        return redirect()->route('admin.tasks.index', [
            'id' => $folder->id,
        ]);      
    }
}