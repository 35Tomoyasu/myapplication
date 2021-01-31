@extends('layout', ['show_user_flag' => $show_user_flag ?? false])

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-primary">
          <div class="panel-heading">フォルダ編集画面</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('admin.folders.update', ['id' => $folder->id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="folder_name">フォルダ名</label>
                <input type="text" class="form-control" name="folder_name" id="folder_name" value="{{ old('folder_name') ?? $folder->name }}" />
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