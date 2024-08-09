@extends('layouts.main')

@section('title')
    {{ __('Корзина') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Ваша корзина') }}</h1>
    @if (count($products))
        @php
            $basketCost = 0;
        @endphp
        <form action="{{ route('basket.clear') }}" method="post" class="text-end mb-4">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                {{ __('Очистить корзину') }}
            </button>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>№</th>
                    <th>{{ __('Наименование') }}</th>
                    <th>{{ __('Цена') }}</th>
                    <th>{{ __('Кол-во') }}</th>
                    <th>{{ __('Стоимость') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    @php
                        $itemPrice = $product->price;
                        $itemQuantity = $product->pivot->quantity;
                        $itemCost = $itemPrice * $itemQuantity;
                        $basketCost = $basketCost + $itemCost;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('catalog.product', [$product->slug]) }}">{{ $product->name }}</a>
                        </td>
                        <td>{{ number_format($itemPrice, 2, '.', '') }}</td>
                        <td>
                            <form action="{{ route('basket.minus', ['id' => $product->id]) }}" method="post"
                                class="d-inline">
                                @csrf
                                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                    <i class="fas fa-minus-square"></i>
                                </button>
                            </form>
                            <span class="mx-1">{{ $itemQuantity }}</span>
                            <form action="{{ route('basket.plus', ['id' => $product->id]) }}" method="post"
                                class="d-inline">
                                @csrf
                                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </form>
                        </td>
                        <td>{{ number_format($itemCost, 2, '.', '') }}</td>
                        <td>
                            <form action="{{ route('basket.remove', ['id' => $product->id]) }}" method="post"
                                class="d-inline">
                                @csrf
                                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-end">{{ __('Итого') }}</th>
                    <th>{{ number_format($basketCost, 2, '.', '') }}</th>
                    <th></th>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <a href="{{ route('basket.checkout') }}" class="btn btn-success">
                {{ __('Оформить заказ') }}
            </a>
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            <p class="mb-0">{{ __('Ваша корзина пуста') }}</p>
        </div>
    @endif
@endsection
