@extends('layouts.admin')

@section('title')
    {{ __('Создание новой категории') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Создание новой категории') }}</h1>
    <form method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
        @include('admin.category.partials.form')
    </form>
@endsection
