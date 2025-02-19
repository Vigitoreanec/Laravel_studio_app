@extends('layouts.app')
@section('title', 'Управление мастерами')

@section('content')
    <div class="container">
        <h1>Панель мастера</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Общая информация</h5>
                        <p class="card-text">Добро пожаловать, {{ Auth::user()->name }}!</p>


                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Действия</h5>
                        @if(Auth::user()->is_admin('admin'))
                            <div class="card-header">
                                <h3 class="card-title">Список мастеров</h3>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('masters.create') }}" class="btn  btn-success">
                                    <i class="fas fa-edit">Создать</i>
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Фото</th>
                                                <th>Имя</th>
                                                <th>Описание</th>
                                                <th>Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($masters as $master)
                                                <tr>
                                                    
                                                    <td>{{ $master->id }}</td>
                                                    <td>
                                                        @if($master->image)
                                                            <img src="{{ asset( $master->image) }}"
                                                                alt="{{ $master->name }}" class="img-thumbnail" width="50">
                                                        @else
                                                            <span class="text-muted">Нет фото</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('masters.index', $master) }}">{{ $master->name }}</a>
                                                    </td>
                                                    
                                                    <td>{{ Str::limit($master->description, 50) }}</td>
                                                    <td>        
                                                        {{-- 1 --}}
                                                        <a href="{{ route('masters.edit', $master) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-edit">Редактировать</i>
                                                        </a>
                                                        {{-- 2 --}}
                                                        <form action="{{ route('masters.destroy', $master) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Вы уверены?')">
                                                                <i class="fas fa-trash">Удалить</i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                
                                                </tr>
                                                
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('master.meetings') }}" class="btn btn-primary">Управление записями</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection