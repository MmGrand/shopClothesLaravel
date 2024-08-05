@extends('layouts.admin')

@section('title')
    {{ __('Создание новой страницы') }}
@endsection

@section('content')
    <h1>{{ __('Создание новой страницы') }}</h1>
    <form method="post" action="{{ route('admin.page.store') }}">
        @include('admin.page.partials.form')
    </form>
@endsection