@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $master->name }}</h1>
        <p>{{ $master->description }}</p>
        <h2>Услуги</h2>
        <div class="row">
            @if($master->services->isNotEmpty())
                @foreach($services as $service)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $service->category->name }}</h5>
                                <p class="card-text">{{ $service->description }}</p>
                                <p class="card-text">{{ $service->price }} руб.</p>
                                @Auth
                                    @if(auth()->user()->role === 'user')
                                        <a href="{{ route('meetings.create', ['master' => $master, 'service' => $service]) }}"
                                            class="btn btn-success">Записаться</a>
                                    @else
                                        <p>Для записи необходимо войти как пользователь.</p>
                                    @endif
                                @else
                                    <p>Для записи необходимо <a href="{{ route('login') }}">войти</a>.</p>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mt-4 alert alert-info">
                    У этого мастера пока нет доступных услуг
                </div>
            @endif
        </div>
    </div>
@endsection