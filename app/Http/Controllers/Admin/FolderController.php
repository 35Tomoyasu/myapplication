<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use App\Folder;
use App\Http\Requests\CreateFolderRequest;
use App\Http\Requests\EditFolderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FolderController extends Controller
{
    /**
     * GET /folders/create
     */
    /**
     * Undocumented function
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.folders.create');
    }

    /**
     * Undocumented function
     *
     * @param CreateFolderRequest $request
     * @return void
     */
    public function store(CreateFolderRequest $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();

        // タイトルに入力値を代入する
        $folder->name = $request->name;
        $folder->user_id = $request->user()->id;
        $folder->created_by = $request->user()->id;
        $folder->updated_by = $request->user()->id;

        // ★ ユーザーに紐づけて保存
        Auth::user()->folders()->save($folder);
        return redirect()->route('admin.tasks.index', [
            'id' => $folder->id,
        ]);
    }

    /**
     * GET /folders/{id}/edit
     */
    /**
     * Undocumented function
     *
     * @param integer $id
     * @return View
     */
    public function edit(int $id): View
    {
        $current_folder = Folder::find($id);

        return view('admin.folders.edit', [
            'folder' => $current_folder,
        ]);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @param EditFolderRequest $request
     * @return void
     */
    public function update(int $id, EditFolderRequest $request)
    {
        $current_folder = Folder::find($id);
        $current_folder->name = $request->name;
        $current_folder->save();

        return redirect()->route('admin.tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $current_folder = Folder::find($id);
        $current_folder->tasks()->delete();
        $current_folder->delete();

        return redirect('/');
    }
}