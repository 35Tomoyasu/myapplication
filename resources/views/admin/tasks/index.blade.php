@extends('layout')

@section('content')
  <div class="container">
    <div class="row">

      <!-- ここからフォルダ表示画面 -->
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">
            <a href="{{ route('admin.folders.create') }}" class="btn btn-success btn-block">
              フォルダを作成
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
              <a href="{{ route('admin.tasks.index', ['id' => $folder->id]) }}" class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : ''  }}" >
                {{ $folder->name }}             
              </a>
            @endforeach
          </div>
        </nav>
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ編集／削除</div>

          <!-- 編集画面へ遷移 -->
          <div class="panel-body">
            <a href="{{ route('admin.folders.edit', ['id' => $current_folder_id]) }}" class="btn btn-primary btn-block">
              選択中のフォルダを編集
            </a>

          <!-- 削除機能 -->
            <form action="{{ route('admin.folders.delete', ['id' => $current_folder_id]) }}" id="form_{{ $folder->id }}" method="post">
              {{ csrf_field() }}
            <a href="#" data-id="{{ $folder->id }}" class="btn btn-danger btn-block" onclick="deleteFolderPost(this);">選択中のフォルダを削除</a>
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
            <a href="{{ route('admin.tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-success btn-block">タスクを追加</a>
            </div>
          </div>
          <table id="sort_table" class="table table-striped table-hover">
            <thead>
            <tr>
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
                <td><a href="{{ route('admin.tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" class="btn btn-xs btn-primary">編集</a></td>

                <!-- 削除機能 -->
                <td>
                <form action="{{ route('admin.tasks.delete', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" id="form_{{ $task->id }}" method="post">
                {{ csrf_field() }}
                <a href="#" data-id="{{ $task->id }}" class="btn btn-xs btn-danger" onclick="deleteTaskPost(this);">削除</a>
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

    function deleteFolderPost(e) {
      'use strict';
    
      if (confirm('本当にフォルダ名【{{ $folder->name }}】を削除しますか?')) {
      document.getElementById('form_' + e.dataset.id).submit();
      }
    }

    function deleteTaskPost(e) {
      'use strict';
    
      if (confirm('本当にタスク名【{{ $task->name }}】を削除しますか?')) {
      document.getElementById('form_' + e.dataset.id).submit();
      }
    }
  </script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
  <script>
    $(document).ready(function() 
        { 
            $("#sort_table").tablesorter(); 
        } 
    );
  </script>
@endsection