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

    /**
     * GET /folders/{id}/edit
     */
    public function showEditForm()
    {
        $current_folder = Folder::find($current_folder_id);

        return view('folders/edit', [
            'current_folder' => $current_folder,
        ]);
    }

    public function edit(EditFolder $request)
    {
        // 1
        $current_folder = Folder::find($folder_id);

        // 2
        $current_folder->name = $request->name;
        $current_folder->save();

        // 3
        return redirect()->route('tasks.index', [
            'id' => $current_folder_id,
        ]);
    }

    // deleteアクションを下記にコーディング
    public function delete(int $id) 
    {
        // ★ 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);
        $current_folder->delete();
        return redirect()->route('tasks.index', [
            'id' => $current_folder_id->id,
        ]);
    }

    // public function delete(Request $request)
    // {
    //     $folder = Folder::find($request->folder_id);
    //     $folder->delete();
    //     return redirect()->route('tasks.index', [
    //         'id' => $folder->id,
    //     ])->with('flash_message', '削除が完了しました'); 
    // }
}