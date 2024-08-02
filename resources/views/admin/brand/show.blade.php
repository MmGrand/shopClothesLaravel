@extends('layouts.admin')

@section('title')
    {{ $brand->name }}
@endsection

@section('content')
    <h1>{{ $brand->name }}</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>{{ __('Название') }}:</strong> {{ $brand->name }}</p>
            <p><strong>{{ __('ЧПУ (англ)') }}:</strong> {{ $brand->slug }}</p>
            <p><strong>{{ __('Краткое описание') }}</strong></p>
            @isset($brand->content)
                <p>{{ $brand->content }}</p>
            @else
                <p>{{ __('Описание отсутствует') }}</p>
            @endisset
        </div>
        <div class="col-md-6">
            <img src="{{ $brand->image ?  Storage::url('catalog/brand/image/' . $brand->image) : asset('img/default.jpg')}}" alt="" class="img-fluid">
        </div>
    </div>
    <a href="{{ route('admin.brand.edit', ['brand' => $brand->slug]) }}" class="btn btn-success">
        {{ __('Редактировать бренд') }}
    </a>
    <form method="post" class="d-inline" action="{{ route('admin.brand.destroy', ['brand' => $brand->slug]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            {{ __('Удалить бренд') }}
        </button>
    </form>
@endsection
