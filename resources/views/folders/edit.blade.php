@extends('layout')

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
            <form action="{{ route('folders.edit', ['id' => $folder->id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="name">フォルダ名</label>
                <input type="text" class="form-control" name="name" id="name"
                       value="{{ old('name') ?? $folder->name }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">変更</button>
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