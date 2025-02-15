@extends('layouts.app')

@section('content')
    @include('parts.menu')

    <main class="container py-4">
        @yield('main-content')
    </main>
@endsection