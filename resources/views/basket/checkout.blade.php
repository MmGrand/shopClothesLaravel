@extends('layouts.main')

@section('title')
    {{ __('Оформление заказа') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Оформить заказ') }}</h1>
    <form method="post" action="{{ route('basket.saveorder') }}">
        @csrf
        <div class="mb-3">
            <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" placeholder="Имя, Фамилия" required maxlength="255"
                value="{{ old('name') ?? '' }}">
            @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <input type="email" class="form-control @error('email')is-invalid @enderror" name="email" placeholder="Адрес почты" required maxlength="255"
                value="{{ old('email') ?? '' }}">
            @error('email')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <input type="text" class="form-control @error('phone')is-invalid @enderror" name="phone" placeholder="Номер телефона" required maxlength="255"
                value="{{ old('phone') ?? '' }}">
            @error('phone')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <input type="text" class="form-control @error('address')is-invalid @enderror" name="address" placeholder="Адрес доставки" required maxlength="255"
                value="{{ old('address') ?? '' }}">
            @error('address')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <textarea class="form-control @error('comment')is-invalid @enderror" name="comment" placeholder="Комментарий" maxlength="255" rows="2">{{ old('comment') ?? '' }}</textarea>
            @error('comment')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">{{ __('Оформить') }}</button>
        </div>
    </form>
@endsection
