<header class="p-3 text-bg-dark mb-5">
	<div class="container">
		<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
			<a href="{{ route('home') }}" class="d-flex align-items-center mb-2 me-2 mb-lg-0 text-white text-decoration-none fs-4">
				{{ __('Магазин') }}
			</a>

			<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
				<li><a href="{{ route('catalog.index') }}" class="nav-link px-2 text-white">{{ __('Каталог') }}</a></li>
				<li><a href="#" class="nav-link px-2 text-white">{{ __('Доставка') }}</a></li>
				<li><a href="#" class="nav-link px-2 text-white">{{ __('Контакты') }}</a></li>
			</ul>

			<form class="d-flex align-items-center justify-content-center gap-2 col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" action="" method="POST">
				@csrf
				<input type="search" class="form-control form-control-dark text-bg-dark" placeholder="{{ __('Поиск по каталогу') }}" aria-label="Search">
				<button type="button" class="btn btn-success">{{ __('Поиск') }}</button>
			</form>

			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
						<a class="nav-link" href="{{ route('basket.index') }}">{{ __('Корзина') }}</a>
				</li>
			</ul>
		</div>
	</div>
</header>
