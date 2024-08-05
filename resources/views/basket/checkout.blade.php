@extends('layouts.main')

@section('title')
    {{ __('Оформление заказа') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Оформить заказ') }}</h1>
    @isset ($profiles)
        @include('basket.partials.select', ['current' => $profile->id ?? 0])
    @endisset
    <form method="post" action="{{ route('basket.saveorder') }}" id="checkout">
        @csrf
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Имя, Фамилия"
                   required maxlength="255" value="{{ old('name') ?? $profile->name ?? '' }}">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Адрес почты"
                   required maxlength="255" value="{{ old('email') ?? $profile->email ?? '' }}">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="phone" placeholder="Номер телефона"
                   required maxlength="255" value="{{ old('phone') ?? $profile->phone ?? '' }}">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="address" placeholder="Адрес доставки"
                   required maxlength="255" value="{{ old('address') ?? $profile->address ?? '' }}">
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="comment" placeholder="Комментарий"
                      maxlength="255" rows="2">{{ old('comment') ?? $profile->comment ?? '' }}</textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">{{ __('Оформить') }}</button>
        </div>
    </form>
@endsection
