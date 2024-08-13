<div class="row">
	@if ($products->isEmpty())
			<div class="col-12 text-center">
					<p class="h4 text-danger mt-4">{{ __('К сожалению, товаров не найдено.') }}</p>
			</div>
	@else
			@foreach ($products as $product)
					<x-catalog.product :product="$product" />
			@endforeach
			{{ $products->links() }}
	@endif
</div>