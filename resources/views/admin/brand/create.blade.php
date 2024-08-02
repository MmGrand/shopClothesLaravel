@extends('layouts.admin')

@section('title')
    {{ __('Создание бренда') }}
@endsection

@section('content')
    <h1>{{ __('Создание нового бренда') }}</h1>
    <form method="post" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
        @include('admin.brand.partials.form')
    </form>
@endsection
