<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
		@foreach ($breadcrumbs as $breadcrumb)
			@if (!$loop->last)
				<li class="breadcrumb-item">
					<a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['title'] }}</a>
				</li>
			@else
				<li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
			@endif
		@endforeach
  </ol>
</nav>