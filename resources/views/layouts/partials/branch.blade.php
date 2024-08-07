<ul class="list-group list-group-flush">
    @foreach ($items->where('parent_id', $parent) as $item)
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('catalog.category', ['category' => $item->slug]) }}">{{ $item->name }}</a>
                @if (count($items->where('parent_id', $item->id)))
                    <span class="badge bg-dark text-white cursor-pointer">
                        <i class="fa fa-plus"></i>
                    </span>
                @endif
            </div>
            @if (count($items->where('parent_id', $item->id)))
                @include('layouts.partials.branch', ['parent' => $item->id])
            @endif
        </li>
    @endforeach
</ul>