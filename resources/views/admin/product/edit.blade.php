@extends('layouts.admin')

@section('title')
    {{ __('Редактирование товара') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Редактирование товара') }}</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.product.update', ['product' => $product->slug]) }}">
        @method('PUT')
        @include('admin.product.partials.form')
    </form>
@endsection
