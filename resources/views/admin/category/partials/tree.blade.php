@php
    $level++;
@endphp
@foreach ($items->where('parent_id', $parent) as $item)
    <tr>
        <td>
            @if ($level)
                {{ str_repeat('—', $level) }}
            @endif
            <a href="{{ route('admin.category.show', ['category' => $item->slug]) }}"
                style="font-weight:@if ($level) normal @else bold @endif">
                {{ $item->name }}
            </a>
        </td>
        <td>{{ iconv_substr($item->content, 0, 150) }}</td>
        <td>
            <a href="{{ route('admin.category.edit', ['category' => $item->slug]) }}">
                <i class="far fa-edit"></i>
            </a>
        </td>
        <td>
            <form action="{{ route('admin.category.destroy', ['category' => $item->slug]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                    <i class="far fa-trash-alt text-danger"></i>
                </button>
            </form>
        </td>
    </tr>
    @if (count($items->where('parent_id', $parent)))
        @include('admin.category.partials.tree', ['level' => $level, 'parent' => $item->id])
    @endif
@endforeach
