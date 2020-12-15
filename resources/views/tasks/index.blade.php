@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <!-- ここからフォルダ表示画面 -->
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">
            <a href="{{ route('folders.create') }}" class="btn btn-success btn-block">
              フォルダを追加する
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
              <a
                  href="{{ route('tasks.index', ['id' => $folder->id]) }}"
                  class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}"
              >
                {{ $folder->name }}
              </a>
            @endforeach
          </div>
        </nav>
      </div>
      <!-- ここからタスク表示画面 -->
      <div class="column col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">タスク</div>
          <div class="panel-body">
            <div class="text-right">
            <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-success btn-block">タスクを追加する</a>
            </div>
          </div>
          <table class="table">
            <thead>
            <tr>

            <!-- 間隔はwidth="%で指定" -->
              <th width="25%">タスク名</th>
              <th width="45%">内容</th>
              <th width="20%">期限</th>
              <th width="10%">状態</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
              <tr>
                <td>{{ $task->name }}</td>
                <td>{{ $task->contents }}</td>
                <td>{{ $task->formatted_finish_date }}</td>
                <td>
                  <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                </td>
                
                <td><a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">編集</a></td>

                <!-- 削除機能を下記にコーディング -->

                
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection