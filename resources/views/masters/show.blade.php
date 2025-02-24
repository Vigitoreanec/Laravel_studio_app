@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $master->name }}</h1>
        <p>{{ $master->description }}</p>
        @include('parts.message')
        <h2>Услуги</h2>
        <div class="row">
            @if($master->services->isNotEmpty())
                @foreach($services as $service)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $service->category->name }}</h5>
                                <p class="card-text">{{ $service->description }}</p>
                                <p class="card-text">{{ $service->price }} руб.</p>
                                @Auth
                                    @if(Auth::user()->is_admin('user'))
                                        <a href="{{ route('meetings.create', ['master' => $master, 'service' => $service]) }}"
                                            class="btn btn-success">Записаться</a>
                                    @else
                                        <p>Для записи необходимо войти как пользователь.</p>
                                    @endif
                                @else
                                    <p>Для записи необходимо <a href="{{ route('login') }}">войти</a>.</p>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mt-4 alert alert-info">
                    У этого мастера пока нет доступных услуг
                </div>
            @endif
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h5>Комментарии</h5>
            </div>
            <div class="card-body">
                {{-- @if(!$master->comments()->where('client_id', auth()->id())->exists()) --}}
                @if(Auth::user()->is_admin('user'))
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Оставить комментарий</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('comments.store', $master) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea name="content" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-success mt-2">Оставить комментарий</button>
                            </form>
                        </div>
                    </div>

                @elseif($master->comments->isEmpty())
                    <p class="text-muted">Пока нет комментариев.</p>

                @endif
                @foreach($master->comments as $comment)
                    <div class="media mb-3">
                        <div class="media-body">
                            <h6 class="mt-0">{{ $comment->client->name }}</h6>
                            <p>{{ $comment->content }}</p>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                        @if(Auth::user()->is_admin('admin'))
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mt-2">Удалить</button>
                            </form>
                        @endif

                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection