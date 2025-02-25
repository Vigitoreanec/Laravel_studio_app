@extends('layouts.app')

@section('content')
    <div class="container">
        @include('parts.message')
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
                        <td>{{ $meeting->service->title }}</td>
                        <td>{{ $meeting->datetime }}</td>
                        <td>{{ $meeting->status }}</td>
                        <td>
                            <a href="{{ route('master.editMeeting', $meeting) }}"
                                class="btn btn-warning btn-sm">Редактировать</a>
                            <form action="{{ route('master.meetings.destroy', $meeting) }}" method="POST"
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