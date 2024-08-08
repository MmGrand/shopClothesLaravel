@extends('layouts.main')

@section('title')
    {{ __('Данные по заказу') }} № {{ $order->id }}
@endsection

@section('content')
    <h1 class="mb-4">{{ __('Данные по заказу') }} № {{ $order->id }}</h1>
    <p class="lead">{{ __('Статус заказа') }}: {{ $statuses[$order->status] }}</p>

    <h3 class="mb-3">{{ __('Состав заказа') }}</h3>
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

    <h3 class="mb-3">{{ __('Данные покупателя') }}</h3>
    <p><strong>{{ __('Имя, фамилия') }}:</strong> {{ $order->name }}</p>
    <p><strong>{{ __('Адрес почты') }}:</strong> <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
    <p><strong>{{ __('Номер телефона') }}:</strong> {{ $order->phone }}</p>
    <p><strong>{{ __('Адрес доставки') }}:</strong> {{ $order->address }}</p>
    @isset($order->comment)
        <p><strong>{{ __('Комментарий') }}:</strong> {{ $order->comment }}</p>
    @endisset
@endsection
