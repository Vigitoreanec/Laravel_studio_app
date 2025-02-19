@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Категория: {{ $category->name }}</h1>
        <div class="row">
            <h2>Мастера</h2>
            @foreach($masters as $master)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $master->name }}</h5>
                            <p class="card-text">{{ $master->description }}</p>
                            <h6>Услуги:</h6>
                            <ul>
                                @foreach($master->services as $service)
                                    @if($service->category_id == $category->id)
                                        <li> Описание: {{ $service->title }}
                                            <p class="card-text">Стоимость: {{ $service->price }} руб.</p>
                                        </li>
                                    
                                    @endif
                                @endforeach
                            </ul>
                            <a href="{{ route('masters.show', $master) }}" class="btn btn-primary">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection