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
              フォルダを追加
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
              <a href="{{ route('tasks.index', ['id' => $folder->id]) }}" class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : ''  }}" >
                {{ $folder->name }}             
              </a>
            @endforeach
          </div>
        </nav>
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ編集／削除</div>
          <div class="panel-body">
            <a href="{{ route('folders.edit', ['id' => $current_folder_id]) }}" class="btn btn-primary btn-block">
              選択中のフォルダを編集
            </a>
            <form action="{{ route('folders.delete', ['id' => $current_folder_id]) }}" method="post">
              {{ csrf_field() }}
              @method('DELETE')
              <input type="submit" value="選択中のフォルダを削除" class="btn btn-danger btn-block">
            </form>
          </div>
        </nav>
      </div>
      <!-- ここからタスク表示画面 -->
      <div class="column col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">タスク</div>
          <div class="panel-body">
            <div class="text-right">
            <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-success btn-block">タスクを追加</a>
            </div>
          </div>
          <table class="table">
            <thead>
            <tr>
            <!-- 間隔はwidth="%で指定" -->
              <th class="task" width="20%">タスク名</th>
              <th class="task" width="45%">内容</th>
              <th class="task" width="15%">期限</th>
              <th class="task" width="10%">優先度</th>
              <th class="task" width="10%">状態</th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
              <tr>
                <td class="task">{{ $task->name }}</td>
                <td class="task">{{ $task->contents }}</td>
                <td class="task">{{ $task->formatted_finish_date }}</td>
                <td class="task">{{ $task->priority }}</td> 
                <td class="task">
                  <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                </td>
                
                <!-- 編集画面へ遷移 -->
                <td><a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" class="btn btn-xs btn-primary">編集</a></td>

                <!-- 削除機能 -->
                <td>
                <form action="{{ route('tasks.delete', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" id="form_{{ $task->id }}" method="post">
                {{ csrf_field() }}
                <a href="#" data-id="{{ $task->id }}" class="btn btn-xs btn-danger" onclick="deletePost(this);">削除</a>
                </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
  /************************************
   削除ボタンを押してすぐにレコードが削除
  されるのも問題なので、一旦javascriptで
  確認メッセージを流す。 
  *************************************/
  
  function deletePost(e) {
    'use strict';
  
    if (confirm('本当に削除していいですか?')) {
    document.getElementById('form_' + e.dataset.id).submit();
    }
  }
  </script>
@endsection