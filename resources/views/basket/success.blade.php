@extends('layouts.main')

@section('title')
    {{ __('Заказ размещен') }}
@endsection

@section('content')
    <h1>{{ __('Заказ размещен') }}</h1>

    <p>{{ __('Ваш заказ успешно размещен. Наш менеджер скоро свяжется с Вами для уточнения деталей') }}.</p>

    <h2>{{ __('Ваш заказ') }}</h2>
    <table class="table table-bordered">
        <tr>
            <th>№</th>
            <th>{{ __('Наименование') }}</th>
            <th>{{ __('Цена') }}</th>
            <th>{{ __('Кол-во') }}</th>
            <th>{{ (__('Стоимость')) }}</th>
        </tr>
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
            <th colspan="4" class="text-right">{{ __('Итого') }}</th>
            <th>{{ number_format($order->amount, 2, '.', '') }}</th>
        </tr>
    </table>

    <h2>{{ __('Ваши данные') }}</h2>
    <p>{{ __('Имя, фамилия') }}: {{ $order->name }}</p>
    <p>{{ __('Адрес почты') }}: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
    <p>{{ __('Номер телефона') }}: {{ $order->phone }}</p>
    <p>{{ __('Адрес доставки') }}: {{ $order->address }}</p>
    @isset($order->comment)
        <p>{{ __('Комментарий') }}: {{ $order->comment }}</p>
    @endisset
@endsection
