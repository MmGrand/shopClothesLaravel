@extends('layouts.main')

@section('title')
    {{ __('Заказ размещен') }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Заказ размещен') }}</h1>

    <p class="lead">{{ __('Ваш заказ успешно размещен. Наш менеджер скоро свяжется с Вами для уточнения деталей') }}.</p>

    <h2 class="mt-4">{{ __('Ваш заказ') }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>№</th>
                <th>{{ __('Наименование') }}</th>
                <th>{{ __('Цена') }}</th>
                <th>{{ __('Кол-во') }}</th>
                <th>{{ __('Стоимость') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price, 2, '.', '') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->cost, 2, '.', '') }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="4" class="text-end">{{ __('Итого') }}</th>
                <th>{{ number_format($order->amount, 2, '.', '') }}</th>
            </tr>
        </tbody>
    </table>

    <h2 class="mt-4">{{ __('Ваши данные') }}</h2>
    <p><strong>{{ __('Имя, фамилия') }}:</strong> {{ $order->name }}</p>
    <p><strong>{{ __('Адрес почты') }}:</strong> <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
    <p><strong>{{ __('Номер телефона') }}:</strong> {{ $order->phone }}</p>
    <p><strong>{{ __('Адрес доставки') }}:</strong> {{ $order->address }}</p>
    @isset($order->comment)
        <p><strong>{{ __('Комментарий') }}:</strong> {{ $order->comment }}</p>
    @endisset
@endsection
