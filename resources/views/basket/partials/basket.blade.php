<a class="nav-link @if ($positions) text-success @endif" href="{{ route('basket.index') }}">
    {{ __('Корзина') }}
    @if ($positions)
        ({{ $positions }})
    @endif
</a>
