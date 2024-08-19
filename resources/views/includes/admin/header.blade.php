<header class="p-3 text-bg-dark mb-5">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <a href="{{ route('admin.index') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none fs-4">
                {{ __('Панель управления') }}
            </a>

            <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('admin.order.index') }}" class="nav-link px-2 text-white">{{ __('Заказы') }}</a></li>
                <li><a href="{{ route('admin.category.index') }}" class="nav-link px-2 text-white">{{ __('Категории') }}</a></li>
                <li><a href="{{ route('admin.brand.index') }}" class="nav-link px-2 text-white">{{ __('Бренды') }}</a></li>
                <li><a href="{{ route('admin.product.index') }}" class="nav-link px-2 text-white">{{ __('Товары') }}</a></li>
                <li><a href="{{ route('admin.user.index') }}" class="nav-link px-2 text-white">{{ __('Пользователи') }}</a></li>
            </ul>

            <div class="d-flex align-items-center">
                <ul class="navbar-nav me-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="languageDropdown">
                            @foreach (config('localization.locales') as $locale)
                                <li><a class="dropdown-item" href="{{ route('localization', $locale) }}">{{ strtoupper($locale) }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a onclick="document.getElementById('logout-form').submit(); return false" href="{{ route('logout') }}" class="nav-link text-white">
                            {{ __('Выйти') }}
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>
