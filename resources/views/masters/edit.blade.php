@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактирование мастера</h1>
        <form action="{{ route('masters.update', $master) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Имя мастера</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $master->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" id="description" class="form-control"
                    required>{{ $master->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="email">MAIL мастера</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $master->email }}" required>
            </div>
            <div class="form-group">
                <label for="image">Фото</label><br />
                <input type="file" name="image" id="image" class="form-control-file">
                @if ($master->image)
                    <img src="{{ asset( $master->image) }}" alt="{{ $master->name }}"
                        width="100" class="mt-2">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
@endsection