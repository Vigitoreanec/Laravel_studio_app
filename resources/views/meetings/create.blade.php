@extends('layouts.app')

@section('content')
    <div class="container">
        @include('parts.message')
        <h1>Запись к мастеру {{ $master->name }}</h1>

        <form action="{{ route('meetings.store', ['master' => $master, 'service' => $service->id]) }}" method="POST">
            @csrf
            <div class="row mb-3">
                <h5 class="card-title"> Категория : {{$service->category->name}}</h5>
            </div>
            <div class="form-group">
                <label for="datetime">Выберите дату и время:</label>
                <input type="datetime-local" name="datetime" id="datetime" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Записаться</button>
        </form>
    </div>
@endsection