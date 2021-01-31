@extends('layoutUserInfo')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-primary">
          <div class="panel-heading">タスク編集画面</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('admin.tasks.update', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="task_name">タスク名</label>
                <input type="text" class="form-control" name="task_name" id="task_name" value="{{ old('task_name') ?? $task->name }}" />
              </div>
              <div class="form-group">
                <label for="contents">内容</label>
                <input type="text" class="form-control" name="contents" id="contents" value="{{ old('contents') ?? $task->contents }}" />
              </div>
              <div class="form-group">
                <label for="status">状態</label>
                <select name="status" id="status" class="form-control">                
                  @foreach(\App\Task::STATUS as $key => $val)
                      <option value="{{ $key }}" {{ $key == old('status', $task->status) ? 'selected' : '' }} >
                        {{ $val['label'] }} 
                      </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="priority">優先度</label>
                <select name="priority" id="priority" class="form-control" >                          
                    @foreach(config('priority') as $key => $priority)
                      <option value="{{ $priority }}" {{ $priority == old('priority', $task->priority) ? 'selected' : '' }} >
                      {{ $priority }}
                      </option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="finish_date">期限</label>
                <input type="text" class="form-control" name="finish_date" id="finish_date"
                       value="{{ old('finish_date') ?? $task->formatted_finish_date }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">変更</button>
              </div>
            </form>
          </div>
        </nav>
        <div class="text-center">
          <a href="{{ route('home') }}" class="btn">ホームへ戻る</a>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  @include('share.flatpickr.scripts')
@endsection