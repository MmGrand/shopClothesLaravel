@extends('layouts.admin')

@section('title')
    {{ __('Товары категории: ') . $category->name }}
@endsection

@section('content')
    <h1>{{ __('Товары категории: ') . $category->name }}</h1>
    @if($category->children->count())
        <ul>
            @foreach ($category->children as $child)
                <li>
                    <a href="{{ route('admin.product.category', ['category' => $child->slug]) }}">
                        {{ $child->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
    <a href="{{ route('admin.product.create') }}" class="btn btn-success mb-4">
        {{ __('Создать товар') }}
    </a>
    @if (count($products))
        <table class="table table-bordered">
            <tr>
                <th width="30%">{{ __('Наименование') }}</th>
                <th width="65%">{{ __('Описание') }}</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @foreach ($products as $product)
                <tr>
                    <td>
                        <a href="{{ route('admin.product.show', ['product' => $product->slug]) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>{{ iconv_substr($product->content, 0, 150) }}</td>
                    <td>
                        <a href="{{ route('admin.product.edit', ['product' => $product->slug]) }}">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.product.destroy', ['product' => $product->slug]) }}" method="post"
                            onsubmit="return confirm('Удалить этот товар?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="far fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $products->links() }}
    @else
        <p>{{ __('Нет товаров в этой категории') }}</p>
    @endif
@endsection
