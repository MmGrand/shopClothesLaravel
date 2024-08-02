@extends('layouts.admin')

@section('title')
    {{ __('Редактирование бренда') }}
@endsection

@section('content')
    <h1>{{ __('Редактирование бренда') }}</h1>
		<form method="post" enctype="multipart/form-data"
          action="{{ route('admin.brand.update', ['brand' => $brand->slug]) }}">
        @method('PUT')
        @include('admin.brand.partials.form')
    </form>
@endsection
