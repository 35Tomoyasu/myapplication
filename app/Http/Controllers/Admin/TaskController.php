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

class TaskController extends Controller
{   
    public function index(int $id)
    {
        // ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        // 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する(1ページ表示最大10件)
        $tasks = $current_folder->tasks()->sortable()->paginate(3);

        return view('admin/tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
    }   

    /**
     * GET /folders/{id}/tasks/create
     */
    public function create(int $id): View
    {   
        return view('admin/tasks/create', [
            'folder_id' => $id ,
        ]);
    }

    public function store(CreateTaskRequest $request, int $id)
    {   
        $current_folder = Folder::find($id);
        $task = new Task();
        
        $task->name = $request->name;
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
    public function edit(int $id, int $task_id): View
    {
        $task = Task::find($task_id);

        return view('admin/tasks/edit', [
            'task' => $task,
        ]);
    }    

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

    public function delete(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        $task->delete();

        return redirect()->route('admin.tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}