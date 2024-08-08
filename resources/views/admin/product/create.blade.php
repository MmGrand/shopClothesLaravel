@extends('layouts.admin')

@section('title')
    {{ __('Создание нового товара') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Создание нового товара') }}</h1>
    <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @include('admin.product.partials.form')
    </form>
@endsection
