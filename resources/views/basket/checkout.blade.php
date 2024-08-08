@extends('layouts.main')

@section('title')
    {{ __('Оформление заказа') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Оформить заказ') }}</h1>

    @isset($profiles)
        @include('basket.partials.select', ['current' => $profile->id ?? 0])
    @endisset

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('basket.saveorder') }}" id="checkout">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Имя, Фамилия') }}</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Имя, Фамилия"
                        required maxlength="255" value="{{ old('name') ?? ($profile->name ?? '') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Адрес почты') }}</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Адрес почты"
                        required maxlength="255" value="{{ old('email') ?? ($profile->email ?? '') }}">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('Номер телефона') }}</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Номер телефона"
                        required maxlength="255" value="{{ old('phone') ?? ($profile->phone ?? '') }}">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('Адрес доставки') }}</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Адрес доставки"
                        required maxlength="255" value="{{ old('address') ?? ($profile->address ?? '') }}">
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">{{ __('Комментарий') }}</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder="Комментарий" maxlength="255" rows="2">{{ old('comment') ?? ($profile->comment ?? '') }}</textarea>
                </div>

                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success">{{ __('Оформить') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
