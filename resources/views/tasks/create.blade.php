@extends('layout')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-success">
          <div class="panel-heading">タスクを追加する</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('tasks.create', ['id' => $folder_id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="name">タスク名</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" />
              </div>
              <div class="form-group">
                <label for="contents">内容</label>
                <input type="text" class="form-control" name="contents" id="contents" value="{{ old('contents') }}" />
              </div>
              <div class="form-group">
                <label for="finish_date">期限</label>
                <input type="text" class="form-control" name="finish_date" id="finish_date" value="{{ old('finish_date') }}" />
                <!-- "datetime-local"で日付時刻設定 -->
                <!-- <input type="datetime-local" class="form-control" name="finish_date" id="" value="{{ old('finish_date') }}" /> -->
              </div>
              <div class="form-group">
                <label for="priority">優先度</label>
                <select type="text" class="form-control" name="priority" id="priority">                          
                    @foreach(config('priority') as $key => $priority)
                        <option value="{{ $priority }}">{{ $priority }}</option>
                    @endforeach
                </select>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-success">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  @include('share.flatpickr.scripts')
@endsection