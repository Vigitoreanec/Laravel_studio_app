@extends('layouts.app')

@section('content')
    <div class="container">
        @include('parts.message')
        <h1>Редактирование записи</h1>

        <form method="POST" action="{{ route('master.meetings.update', $meeting->id) }}">
            @csrf
            @method('PUT')
            {{-- //1 --}}
            <div class="form-group">
                <label for="status">Статус</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $meeting->status === 'pending' ? 'selected' : '' }}>Ожидание</option>
                    <option value="confirmed" {{ $meeting->status === 'confirmed' ? 'selected' : '' }}>Подтверждено</option>
                    <option value="cancelled" {{ $meeting->status === 'cancelled' ? 'selected' : '' }}>Отменено</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Сохранить</button>


        </form>

    </div>
@endsection