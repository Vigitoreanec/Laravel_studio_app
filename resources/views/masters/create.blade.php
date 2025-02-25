@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создание мастера</h1>
        @if (Auth::user()->is_admin('admin'))


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
                        value="{{ old('description')}}"></textarea>
                </div>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group">
                    <label for="email">Почта</label>
                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        autofocus value="{{ old('email')}} @nailstudio.com " required>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="form-group">
                    <label for="category_id">Доступные услуги</label>

                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Выберите услугу</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="number" name="price" id="price" class="form-control" step="100" placeholder="Введите цену">
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Фото</label><br />
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        @else
            <p>У вас нет прав доступа </p>
        @endif
    </div>
@endsection