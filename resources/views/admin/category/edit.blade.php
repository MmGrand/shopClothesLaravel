@extends('layouts.admin')

@section('title')
    {{ __('Редактирование категории') }}
@endsection

@section('content')
    <h1>{{ __('Редактирование категории') }}</h1>
    <form method="post" enctype="multipart/form-data"
        action="{{ route('admin.category.update', ['category' => $category->slug]) }}">
        @method('PUT')
        @include('admin.category.partials.form')
    </form>
@endsection
