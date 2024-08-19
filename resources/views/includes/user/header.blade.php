<header class="p-3 text-bg-dark mb-5">
    <div class="container">
        <div
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start navbar-expand-lg">
            <a href="{{ route('home') }}"
                class="d-flex align-items-center mb-2 me-2 mb-lg-0 text-white text-decoration-none fs-4">
                <img src="{{ asset('img/logo.svg') }}" alt="Магазин одежды" class="bi me-2" width="40" height="32">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('catalog.index') }}" class="nav-link px-2 text-white">{{ __('Каталог') }}</a></li>
            </ul>

            <form class="d-flex align-items-center justify-content-center gap-2 col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3"
                role="search" action="{{ route('catalog.search') }}">
                <input type="search" name="query" class="form-control form-control-dark text-bg-dark"
                    placeholder="{{ __('Поиск по каталогу') }}" aria-label="Search" />
                <button type="submit" class="btn btn-primary">{{ __('Поиск') }}</button>
            </form>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item" id="top-basket">
                    <a class="nav-link px-2 @if ($positions) text-success @endif"
                        href="{{ route('basket.index') }}">
                        {{ __('Корзина') }}
                        @if ($positions) ({{ $positions }})
                        @endif
                    </a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link px-2 text-white" href="{{ route('login') }}">{{ __('Войти') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link px-2 text-white"
                                href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link px-2 text-white"
                            href="{{ route('user.index') }}">{{ __('Личный кабинет') }}</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </header>
