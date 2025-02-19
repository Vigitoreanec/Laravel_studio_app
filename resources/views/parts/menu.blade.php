<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand @if (Route::is('index')) active @endif" href="{{ route('index') }}">Студия маникюра</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link @if (Route::is('masters.index')) active @endif"
                        href="{{ route('masters.index') }}">Мастера</a>
                </li>
                {{-- @if(Auth::user()->is_admin) --}}
                @guest
                @else
                @if(Auth::user()->is_admin('admin') || Auth::user()->is_admin('master'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('master.management') }}">Панель мастера</a>
                    </li>
                @endif
                @endauth
                <form class="d-flex" action="{{ route('categories.search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Поиск по категориям"
                        aria-label="Search" minlength="3" required>
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            {{ Auth::user()->name }}
                            <button type="submit" class="btn btn-dark">Выйти</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Войти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>