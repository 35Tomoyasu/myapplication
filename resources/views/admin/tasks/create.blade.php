@extends('layoutUserInfo')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-success">
          <div class="panel-heading">タスク追加画面</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('admin.tasks.create', ['id' => $folder_id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="task_name">タスク名</label>
                <input type="text" class="form-control" name="task_name" id="task_name" value="{{ old('task_name') }}" />
              </div>
              <div class="form-group">
                <label for="contents">内容</label>
                <input type="text" class="form-control" name="contents" id="contents" value="{{ old('contents') }}" />
              </div>
              <div class="form-group">
                <label for="priority">優先度</label>
                <select type="text" class="form-control" name="priority" id="priority"> 
                  <option disabled selected value>選択してください</option>                  
                  @foreach(config('priority') as $key => $priority)
                      <option value="{{ $priority }}">{{ $priority }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="finish_date">期限</label>
                <input type="text" class="form-control" name="finish_date" id="finish_date" value="{{ old('finish_date') }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-success">追加</button>
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