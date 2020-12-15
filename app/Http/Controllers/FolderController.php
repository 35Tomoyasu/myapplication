<?php

namespace App\Http\Controllers;

use App\Folder;

// バリデーションの機能を有効にする
use App\Http\Requests\CreateFolder;

// クラスのインポート
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // public function create(Request $request)
    public function create(CreateFolder $request) //※引数の型変更
    {
       
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->name = $request->name;
        $folder->user_id = $request->user()->id;
        $folder->created_by = $request->user()->id;
        $folder->updated_by = $request->user()->id;

        // インスタンスの状態をデータベースに書き込む
        // $folder->save();
        // ★ ユーザーに紐づけて保存
        Auth::user()->folders()->save($folder);
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}