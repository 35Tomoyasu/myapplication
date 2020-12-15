<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Task;
use Illuminate\Http\Request;
// ★ Authクラスをインポートする
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{   
    public function index(int $id)
    {
        // ★ ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();
        
        // ✗すべてのフォルダを取得する
        // $folders = Folder::all();

        // ★ 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);

        // ★選ばれたフォルダに紐づくタスクを取得する
        // ✗$tasks = Task::where('folder_id', $current_folder->id)->get();
        $tasks = $current_folder->tasks()->get(); 

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
    }   

    /**
     * GET /folders/{id}/tasks/create
     */
    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(CreateTask $request, int $id)
    {   

        $current_folder = Folder::find($id);
        
        $task = new Task();
        $task->name = $request->name;
        $task->contents = $request->contents;
        $task->finish_date = $request->finish_date;
        $task->status = 3;
        $task->created_by = $request->user()->id;
        $task->updated_by = $request->user()->id;
        // $task->category

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

        /**
     * GET /folders/{id}/tasks/{task_id}/edit
     */
    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }    

    public function edit(int $id, int $task_id, EditTask $request)
    {
        
        $task = Task::find($task_id);

        
        $task->name = $request->name;
        $task->contents = $request->contents;
        $task->status = $request->status;
        $task->finish_date = $request->finish_date;
        $task->save();

        
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }

    // deleteアクションを下記にコーディング
     


}
