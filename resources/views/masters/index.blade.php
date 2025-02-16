@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Все мастера</h1>
    <div class="row">
        @foreach($masters as $master)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $master->name }}</h5>
                        <p class="card-text">{{ $master->description }}</p>
                        <a href="{{ route('masters.clients', $master) }}" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection