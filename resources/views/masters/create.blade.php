@extends('layouts.app')

@section('content')
<div class="container">
    @include('parts.message')
    <h1>Создание мастера</h1>
    @if (Auth::user()->is_admin('admin'))
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <form action="{{ route('masters.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Имя мастера</label>
            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" autofocus
                value="{{ old('name')}}">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea id="description"
                class="form-control @error('description') is-invalid @enderror" name="description" autofocus
                value="{{ old('description')}}">{{old('description')}}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>

        <div class="form-group">
            <label for="email">Почта "@nailstudio.com" </label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                autofocus value="{{ old('email') . "@nailstudio.com"}}" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Доступные услуги</label>

            <select name="category_id" id="category_id" class="form-control">
                <label value="">Выберите услугу</label>
                @foreach ($categories as $category)
                <option @if ($category->id == old('category_id')) selected @endif value="{{$category->id}}">
                    {{$category->name}}
                </option>
                @endforeach
            </select>
        </div>
            <div class="form-group">
                <label for="price">Цена</label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
                    value="{{ old('price')}}" required step="100" placeholder="Введите цену">
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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