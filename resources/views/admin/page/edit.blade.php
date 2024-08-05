@extends('layouts.admin')

@section('title')
    {{ __('Редактирование страницы') }}
@endsection

@section('content')
    <h1>{{ __('Редактирование страницы') }}</h1>
    <form method="post" action="{{ route('admin.page.update', ['page' => $page->slug]) }}">
        @method('PUT')
        @include('admin.page.partials.form')
    </form>
@endsection
