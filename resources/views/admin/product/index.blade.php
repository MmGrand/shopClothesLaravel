@extends('layouts.admin')

@section('title')
    {{ __('Все товары') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Все товары') }}</h1>

    @if (count($roots))
        <ul class="list-group mb-4">
            @foreach ($roots as $root)
                <li class="list-group-item">
                    <a href="{{ route('admin.product.category', ['category' => $root->slug]) }}">
                        {{ $root->name }}
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
            <thead>
                <tr>
                    <th width="30%">{{ __('Наименование') }}</th>
                    <th width="55%">{{ __('Описание') }}</th>
                    <th><i class="fas fa-edit"></i></th>
                    <th><i class="fas fa-trash-alt"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <a href="{{ route('admin.product.show', ['product' => $product->slug]) }}">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td>{{ Str::limit($product->content, 150) }}</td>
                        <td>
                            <a href="{{ route('admin.product.edit', ['product' => $product->slug]) }}">
                                <i class="far fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.product.destroy', ['product' => $product->slug]) }}"
                                method="post" onsubmit="return confirm('Удалить этот товар?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                    <i class="far fa-trash-alt text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $products->links() }}
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            {{ __('Нет товаров') }}
        </div>
    @endif
@endsection
