@extends('layouts.admin')

@section('title')
    {{ __('Редактирование заказа') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Редактирование заказа') }}</h1>
    <form method="post" action="{{ route('admin.order.update', ['order' => $order->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status" class="form-label">{{ __('Статус заказа') }}</label>
            @php $status = old('status') ?? $order->status ?? 0 @endphp
            <select name="status" id="status" class="form-control">
                @foreach ($statuses as $key => $value)
                    <option value="{{ $key }}" @if ($key == $status) selected @endif>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Имя, Фамилия') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Имя, Фамилия" required
                maxlength="255" value="{{ old('name') ?? ($order->name ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Адрес почты') }}</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Адрес почты" required
                maxlength="255" value="{{ old('email') ?? ($order->email ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">{{ __('Номер телефона') }}</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Номер телефона" required
                maxlength="255" value="{{ old('phone') ?? ($order->phone ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">{{ __('Адрес доставки') }}</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Адрес доставки" required
                maxlength="255" value="{{ old('address') ?? ($order->address ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">{{ __('Комментарий') }}</label>
            <textarea class="form-control" id="comment" name="comment" placeholder="Комментарий" maxlength="255" rows="2">{{ old('comment') ?? ($order->comment ?? '') }}</textarea>
        </div>

        <div class="mb-3 text-end">
            <button type="submit" class="btn btn-success">{{ __('Сохранить') }}</button>
        </div>
    </form>
@endsection
