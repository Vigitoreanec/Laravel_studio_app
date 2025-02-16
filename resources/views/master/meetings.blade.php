@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Управление записями</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Клиент</th>
                    <th>Услуга</th>
                    <th>Дата и время</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meetings as $meeting)
                    <tr>
                        <td>{{ $meeting->id }}</td>
                        <td>{{ $meeting->client->name }}</td>
                        <td>{{ $meeting->service->name }}</td>
                        <td>{{ $meeting->appointment_time }}</td>
                        <td>{{ $meeting->status }}</td>
                        <td>
                            <a href="{{ route('master.meetings.edit', $meeting->id) }}"
                                class="btn btn-warning btn-sm">Редактировать</a>
                            <form action="{{ route('master.meetings.destroy', $meeting->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection