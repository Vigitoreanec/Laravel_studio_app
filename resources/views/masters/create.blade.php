@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создание мастера</h1>
        <form action="{{ route('masters.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Имя мастера</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" autofocus
                    value="{{ old('name')}}" required>
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" id="description"
                    class="form-control @error('description') is-invalid @enderror" autofocus
                    value="{{ old('description')}}" required></textarea>
            </div>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-group">
                <label for="email">Почта</label>
                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                    autofocus value="{{ old('email')}}" required>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-group">
                <label for="image">Фото</label><br />
                <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection