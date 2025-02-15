@extends('layouts.main')

@section('title', 'Наши мастера')

@include('parts.menu')    

@section('content')
    <div class="row row-cols-1 row-cols-lg-2 g-4">
        @foreach($masters as $master)
            <div class="col">
                <div class="card shadow-sm h-100">
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
                                @include(
                                    'masterServices.master_service',
                                    ['master' => $master, 'categories' => $categories]
                                )
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Модальное окно записи -->
    <div class="modal fade" id="bookingModal" tabindex="-1">
        <!-- Содержимое модального окна -->
    </div>
@endsection