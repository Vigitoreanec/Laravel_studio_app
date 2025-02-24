@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Клиенты мастера: {{ $master->name }}</h1>
        @if ($master->meetings)
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Клиент</th>
                        <th>Дата приема</th>
                        <th>Услуга</th>
                        <th>Категория услуги</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($master->meetings as $meeting)
                        <tr>
                            <td>{{ $meeting->client->name }}</td>
                            <td>{{ $meeting->datetime }}</td>
                            <td>{{ $meeting->service->price }} ₽</td>
                            <td>{{ $meeting->service->category->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @guest
            @else
                @if(Auth::user()->is_admin)
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Скачать расписание</h5>
                        </div>
                        <div class="card-body">

                            <a href="{{ route('masters.export.txt', $master) }}" class="btn btn-secondary">
                                Скачать TXT
                            </a>
                        </div>
                    </div>
                @endif
            @endguest
        @else
            <div class="mt-4 alert alert-info">
                У этого мастера пока нет клиентов
            </div>
        @endif
    </div>
@endsection