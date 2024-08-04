@php $level++ @endphp
@foreach ($items->where('parent_id', $parent) as $item)
    <option value="{{ $item->id }}" @if ($item->id == $category_id) selected @endif>
        @if ($level) {!! str_repeat('&nbsp;&nbsp;&nbsp;', $level) !!}  @endif {{ $item->name }}
    </option>
    @if (count($items->where('parent_id', $parent)))
        @include('admin.product.partials.branch', ['level' => $level, 'parent' => $item->id])
    @endif
@endforeach
