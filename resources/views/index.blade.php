@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-5">Наши мастера</h1>
        <div class="row">
            @foreach($masters as $master)
                <div class="col-md-6 mb-4">
                    <div class="card master-card">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset($master->image ?? 'images/nail.webp') }}"
                                    class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $master->name }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $master->name }}</h5>
                                    <p class="card-text">{{ $master->description }}</p>
                                    <a href="{{ route('masters.show', $master) }}" class="btn btn-primary">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection






{{-- @extends('layouts.main')

@section('title', 'Наши мастера')

@include('parts.menu')

@section('content')
<div class="row row-cols-1 row-cols-lg-2 g-4">
    @foreach($masters as $master)
    <div class="col">
        <div class="card shadow-sm h-50">
            <div class="row g-0">
                <!-- Фото мастера -->
                <div class="col-md-4">
                    <img src="{{ asset($master->photo ?? 'images/default-master.jpg') }}"
                        class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $master->name }}">
                </div>

                <!-- Информация о мастере -->
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title mb-4">{{ $master->name }}</h3>
                        <p class="card-text text-muted">{{ $master->description }}</p>

                        <!-- Подключаем частичное представление с услугами -->
                        <a {{ action('masterServices.master_service', $master) }} class="btn btn-success">создать Пост
                        </a>
                        {{-- @include(
                        'masterServices.master_service',
                        ['master' => $master, 'categories' => $categories]
                        ) --}}
                        {{--
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div> --}}

<!-- Модальное окно записи -->
{{-- <div class="modal fade" id="bookingModal" tabindex="-1">
    <!-- Содержимое модального окна -->
</div>
@endsection --}}