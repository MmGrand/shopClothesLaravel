@csrf
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
    <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Имя, Фамилия') }}" required
        maxlength="255" value="{{ old('name') ?? ($order->name ?? '') }}">
</div>

<div class="mb-3">
    <label for="email" class="form-label">{{ __('Адрес почты') }}</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Адрес почты') }}" required
        maxlength="255" value="{{ old('email') ?? ($order->email ?? '') }}">
</div>

<div class="mb-3">
    <label for="phone" class="form-label">{{ __('Номер телефона') }}</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="{{ __('Номер телефона') }}" required
        maxlength="255" value="{{ old('phone') ?? ($order->phone ?? '') }}">
</div>

<div class="mb-3">
    <label for="address" class="form-label">{{ __('Адрес доставки') }}</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="{{ __('Адрес доставки') }}" required
        maxlength="255" value="{{ old('address') ?? ($order->address ?? '') }}">
</div>

<div class="mb-3">
    <label for="comment" class="form-label">{{ __('Комментарий') }}</label>
    <textarea class="form-control" id="comment" name="comment" placeholder="{{ __('Комментарий') }}" maxlength="255" rows="2">{{ old('comment') ?? ($order->comment ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="amount" class="form-label">{{ __('Сумма') }}</label>
    <input type="number" class="form-control" id="amount" name="amount" placeholder="{{ __('Сумма') }}"
        value="{{ old('amount') ?? ($order->amount ?? '') }}">
</div>

<div class="mb-3 text-end">
    <button type="submit" class="btn btn-success">{{ __('Сохранить') }}</button>
</div>
