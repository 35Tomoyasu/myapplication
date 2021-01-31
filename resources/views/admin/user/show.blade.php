@extends('layoutHome')

@section('content')
  <!-- ここからフォルダ表示画面 -->
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">ユーザー情報画面</div>
          <div class="panel-body">
            <div class="form-group">
              <label for="name">ユーザー名</label>
              <div>{{ $user->name }}</div>
            </div>
            <div class="form-group">
              <label for="email">メールアドレス</label>
              <div>{{ $user->email }}</div>
            </div>
            <label for="created_at">登録日時</label>
              <div>{{ $created_at }}</div>
            </div>
            <div class="text-center">
              <a href="{{ route('admin.user.edit', ['id' => Auth::user()->id]) }}" class="btn btn-primary">ユーザー情報の編集</a>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection