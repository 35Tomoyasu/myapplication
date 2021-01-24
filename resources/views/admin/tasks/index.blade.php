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
              <a href="{{ route('admin.tasks.index', ['id' => $folder->id]) }}" class="list-group-item {{ $current_folder->id === $folder->id ? 'active' : ''  }}" >
                {{ $folder->name }}             
              </a>
            @endforeach
          </div>
        </nav>
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ編集／削除</div>
          <div class="panel-body">

            <!-- 編集画面へ遷移 -->
            <a href="{{ route('admin.folders.edit', ['id' => $current_folder->id]) }}" class="btn btn-primary btn-block">
              選択中のフォルダを編集
            </a>

            <!-- 削除機能 -->
            <form action="{{ route('admin.folders.delete', ['id' => $current_folder->id]) }}" id="form_{{ $current_folder->id }}" method="post">
              {{ csrf_field() }}
            <a href="#" data-id="{{ $current_folder->id }}" class="btn btn-danger btn-block" onclick="deleteFolderPost(this, '{{ $current_folder->name }}');">選択中のフォルダを削除</a>
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
            <a href="{{ route('admin.tasks.create', ['id' => $current_folder->id]) }}" class="btn btn-success btn-block">タスクを追加</a>
            </div>
          </div>
          <table class="table">
            <thead>
            <tr>
              <th class="text-center" width="20%">タスク名</th>
              <th class="text-center" width="45%">内容</th>
              <th class="text-center" width="10%">状態</th>
              <th class="text-center" width="10%">優先度</th>
              
              <!-- $direction: パラメータ(asc or desc)を取得 -->
              <th class="text-center sort {{ $direction }}" width="15%">@sortablelink('finish_date', '期限')</th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
              <tr>
                <td class="text-center">{{ $task->name }}</td>
                <td class="text-center">{{ $task->contents }}</td>
                <td class="text-center">
                  <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                </td>
                <td class="text-center">{{ $task->priority }}</td> 

                <!-- 期限カラムの背景色について、期限過ぎた場合:灰、期限当日〜2日未満:赤、期限まで2日以上〜4日未満:黃にする -->
                @if (\Carbon\Carbon::createFromFormat('Y/m/d H:i', $task->formatted_finish_date) < \Carbon\Carbon::now())
                  <td class="text-center over">{{ $task->formatted_finish_date }}</td>
                @elseif (\Carbon\Carbon::createFromFormat('Y/m/d H:i', $task->formatted_finish_date) >= \Carbon\Carbon::now() && \Carbon\Carbon::createFromFormat('Y/m/d H:i', $task->formatted_finish_date) < \Carbon\Carbon::now()->addDay(2))
                  <td class="text-center limit">{{ $task->formatted_finish_date }}</td>
                @elseif (\Carbon\Carbon::createFromFormat('Y/m/d H:i', $task->formatted_finish_date) >= \Carbon\Carbon::now()->addDay(2) && \Carbon\Carbon::createFromFormat('Y/m/d H:i', $task->formatted_finish_date) < \Carbon\Carbon::now()->addDay(4))
                  <td class="text-center deadline">{{ $task->formatted_finish_date }}</td>
                @else
                  <td class="text-center">{{ $task->formatted_finish_date }}</td>
                @endif
                
                <!-- 編集画面へ遷移 -->
                <td><a href="{{ route('admin.tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" class="btn btn-xs btn-primary">編集</a></td>

                <!-- 削除機能 -->
                <td>
                <form action="{{ route('admin.tasks.delete', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" id="form_{{ $task->id }}" method="post">
                {{ csrf_field() }}
                <a href="#" data-id="{{ $task->id }}" class="btn btn-xs btn-danger" onclick="deleteTaskPost(this, '{{ $task->name }}');">削除</a>
                </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <!-- ページングの設定（※ソート条件を反映させる） -->
        <div class="text-center">
        {{ $tasks->appends(request()->query())->links() }}
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

    function deleteFolderPost(e ,name) {
      'use strict';
    
      if (confirm('本当に、フォルダ名【' + name + '】を削除しますか?')) { 
        document.getElementById('form_' + e.dataset.id).submit();
      }
    }

    function deleteTaskPost(e ,name) {
      'use strict';
    
      if (confirm('本当に、タスク名【' + name + '】を削除しますか?')) {
        document.getElementById('form_' + e.dataset.id).submit();
      }
    }
  </script>
@endsection