@extends('layoutUserInfo')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-primary">
          <div class="panel-heading">ユーザー編集画面</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('admin.user.update', ['id' => Auth::user()->id]) }}" method="POST">
              @csrf
              <div class="form-group">
              <label for="name">ユーザー名</label>
              <div>
                <input class="form-control" name="name" value="{{ $user->name }}">
              </div>
            </div>
            <div class="form-group">
              <label for="email">メールアドレス</label>
              <div>
                <input class="form-control" name="email" value="{{ $user->email }}">
              </div>
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

