@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Панель мастера</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Общая информация</h5>
                        <p class="card-text">Добро пожаловать, {{ Auth::user()->name }}!</p>
                        

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Быстрые действия</h5>
                        <a href="{{ route('master.meetings') }}" class="btn btn-primary">Управление записями</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection