@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-success">
          <div class="panel-heading">フォルダ作成画面</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form action="{{ route('admin.folders.create') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="folder_name">フォルダ名</label>
                <input type="text" class="form-control" name="folder_name" id="folder_name" value="{{ old('folder_name') }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-success">作成</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection