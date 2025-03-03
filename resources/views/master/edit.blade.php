@extends('layouts.app')

@section('content')
    <div class="container">
        @include('parts.message')
        <h1>Редактирование записи</h1>

        {{-- <form method="POST" action="{{ route('master.meetings.updateMeeting', $meeting->id) }}">
            @csrf
            @method('PUT') --}}
            <p class="card-text">

                <strong>Статус:</strong> <span id="statusMeeting">{{ $meeting->status }}</span><br>

            </p>
            {{-- //1
            <div class="form-group">
                <label for="status">Статус</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $meeting->status === 'pending' ? 'selected' : '' }}>Ожидание</option>
                    <option value="confirmed" {{ $meeting->status === 'confirmed' ? 'selected' : '' }}>Подтверждено</option>
                    <option value="cancelled" {{ $meeting->status === 'cancelled' ? 'selected' : '' }}>Отменено</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Сохранить</button> --}}


            <button data-id="{{$meeting->id}}" class="btn btn-warning btn-sm changeMeeting">
                Изменить статус
            </button>

            {{--
        </form> --}}

    </div>
    {{-- <script>

        let button = document.querySelectorAll('.changeMeeting');
        button.forEach((elem) => {
            elem.addEventListener('click', () => {
                let id = elem.getAttribute('data-id');
                //console.log(id);
                axios.put(`/master/meetings/${id}/update/meeting`)
                    .then(response => {
                        document.getElementById('statusMeeting').textContent = response.data.status;
                        alert('Статус успешно изменен!');
                    })
                    .catch(error => {
                        console.error('Ошибка:', error);
                        alert('Произошла ошибка при изменении.');
                    });
            })
        })
    </script> --}}
@endsection