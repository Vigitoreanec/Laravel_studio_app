@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Результаты поиска по запросу: {{ $query ?? 'Все категории' }}</h1>
        <div class="row">

            @forelse($categories as $category)
                @foreach($category->services as $service)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Услуга: {{ $category->name }}</h5>
                                <p class="card-text">Стоимость: {{ $service->price }} руб.</p>
                                <a href="{{ route('categories.show', $category) }}"
                                    class="btn btn-primary stretched-link">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @empty
                <div class="mt-4 alert alert-info">
                    Нет пока таких категорий услуг
                </div>
            @endforelse

        </div>
    </div>
@endsection