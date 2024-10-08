@extends('layouts.main')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>{{ $product->name }}</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 position-relative">
                            <div class="position-absolute">
                                @if($product->new)
                                    <span class="badge bg-info text-white ml-1">{{ __('Новинка') }}</span>
                                @endif
                                @if($product->hit)
                                    <span class="badge bg-danger ml-1">{{ __('Лидер продаж') }}</span>
                                @endif
                                @if($product->sale)
                                    <span class="badge bg-success ml-1">{{ __('Распродажа') }}</span>
                                @endif
                            </div>
                            <img src="https://via.placeholder.com/400x400"
                                alt="" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <p>{{ __('Цена') }}: {{ number_format($product->price, 2, '.', '') }}</p>
                            <form action="{{ route('basket.add', ['id' => $product->id]) }}"
                                method="post" class="d-inline add-to-basket">
                              @csrf
                              <label class="mb-3" for="input-quantity">{{ __('Количество') }}</label>
                              <input type="text" name="quantity" id="input-quantity" value="1"
                                     class="form-control mx-2 w-25 mb-3">
                              <button type="submit" class="btn btn-primary">{{ __('Добавить в корзину') }}</button>
                          </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="mt-4 mb-0">{{ $product->content }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        @if($product->category)
                            <div class="col-md-6">
                                {{ __('Категория') }}:
                                <a href="{{ route('catalog.category', ['category' => $product->category->slug]) }}">
                                    {{ $product->category->slug }}
                                </a>
                            </div>
                        @endif
                        @if($product->brand)
                            <div class="col-md-6 text-right">
                                {{ __('Бренд') }}:
                                <a href="{{ route('catalog.brand', ['brand' => $product->brand->slug]) }}">
                                    {{ $product->brand->slug }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
