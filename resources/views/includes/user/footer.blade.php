<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-body-secondary">© {{ date('Y') }} {{ __('Магазин') }}</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="{{ route('home') }}" class="nav-link px-2 text-body-secondary">{{ __('Главная') }}</a></li>
      <li class="nav-item"><a href="{{ route('catalog.index') }}" class="nav-link px-2 text-body-secondary">{{ __('Каталог') }}</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle px-2 text-body-secondary" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{ strtoupper(app()->getLocale()) }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
          @foreach (config('localization.locales') as $locale)
            <li>
              <a class="dropdown-item" href="{{ route('localization', $locale) }}">{{ strtoupper($locale) }}</a>
            </li>
          @endforeach
        </ul>
      </li>
    </ul>
  </footer>
</div>