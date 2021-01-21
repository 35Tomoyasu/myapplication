<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Folder;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TaskController extends Controller
{   
    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function index(int $id, Request $request)
    {
        // ユーザーのフォルダを取得
        $folders = Auth::user()->folders()->get();

        // 選ばれたフォルダを取得
        $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得(1ページ最大10件まで表示)
        $tasks = $current_folder->tasks()->sortable()->paginate(3);

        return view('admin.tasks.index', [
            'folders' => $folders,
            'current_folder' => $current_folder, //current_folderの情報を全て渡す
            'tasks' => $tasks,
            'direction' => $request->direction,
        ]);
    }   

    /**
     * GET /folders/{id}/tasks/create
     */
    /**
     * Undocumented function
     *
     * @param integer $id
     * @return View
     */
    public function create(int $id): View
    {   
        return view('admin.tasks.create', [
            'folder_id' => $id ,
        ]);
    }

    /**
     * Undocumented function
     *
     * @param CreateTaskRequest $request
     * @param integer $id
     * @return void
     */
    public function store(CreateTaskRequest $request, int $id)
    {   
        $current_folder = Folder::find($id);
        $task = new Task();
        
        $task->name = $request->task_name;
        $task->contents = $request->contents;
        $task->finish_date = $request->finish_date;
        $task->priority = $request->priority;
        $task->created_by = $request->user()->id;
        $task->updated_by = $request->user()->id;
    
        $current_folder->tasks()->save($task);

        return redirect()->route('admin.tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    /*
     * GET /folders/{id}/tasks/{task_id}/edit
     */
    /**
     * Undocumented function
     *
     * @param integer $id
     * @param integer $task_id
     * @return View
     */
    public function edit(int $id, int $task_id): View
    {
        $task = Task::find($task_id);

        return view('admin.tasks.edit', [
            'task' => $task,
        ]);
    }    

    /**
     * Undocumented function
     *
     * @param integer $id
     * @param integer $task_id
     * @param EditTaskRequest $request
     * @return void
     */
    public function update(int $id, int $task_id, EditTaskRequest $request)
    {
        $task = Task::find($task_id);

        $task->name = $request->name;
        $task->contents = $request->contents;
        $task->finish_date = $request->finish_date;
        $task->priority = $request->priority;
        $task->status = $request->status;

        $task->save();

        return redirect()->route('admin.tasks.index', [
            'id' => $task->folder_id,
        ]);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @param integer $task_id
     * @return void
     */
    public function delete(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        $task->delete();

        return redirect()->route('admin.tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}