<ul>
    @foreach ($items->where('parent_id', $parent) as $item)
        <li>
            <a href="{{ route('catalog.category', ['category' => $item->slug]) }}">{{ $item->name }}</a>
            @if (count($items->where('parent_id', $item->id)))
                <span class="badge text-bg-dark">
                    <i class="fa fa-plus"></i>
                </span>
                @include('layouts.partials.branch', ['parent' => $item->id])
            @endif
        </li>
    @endforeach
</ul>
