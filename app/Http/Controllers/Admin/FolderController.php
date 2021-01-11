<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use App\Folder;
use App\Http\Requests\CreateFolder;
use App\Http\Requests\EditFolder;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FolderController extends Controller
{
    /**
     * GET /folders/create
     */
    public function create(): View
    {
        return view('admin/folders/create');
    }

    public function store(CreateFolder $request) //※引数の型変更
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
        return redirect()->route('admin.tasks.index', [
            'id' => $folder->id,
        ]);
    }

    /**
     * GET /folders/{id}/edit
     */
    public function edit(int $id): View
    {
        $current_folder = Folder::find($id);

        return view('admin/folders/edit', [
            'folder' => $current_folder,
        ]);
    }

    public function update(int $id, EditFolder $request)
    {
        // 1
        $current_folder = Folder::find($id);

        // 2
        $current_folder->name = $request->name;
        $current_folder->save();

        // 3
        return redirect()->route('admin.tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    public function delete(int $id) 
    {
        // ★ 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);

        // ★ フォルダに紐づくタスクの削除
        $current_folder->tasks()->delete();

        $current_folder->delete();

        return redirect('/');
    }
}