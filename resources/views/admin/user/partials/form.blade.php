@csrf
<div class="mb-3">
    <label for="name" class="form-label">{{ __('Имя, Фамилия') }}</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Имя, Фамилия') }}" required
        maxlength="255" value="{{ old('name') ?? ($user->name ?? '') }}">
</div>

<div class="mb-3">
    <label for="email" class="form-label">{{ __('Адрес почты') }}</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Адрес почты') }}" required
        maxlength="255" value="{{ old('email') ?? ($user->email ?? '') }}">
</div>

<div class="mb-3">
    <label for="password" class="form-label">{{ __('Пароль') }}</label>
    <input type="password" class="form-control" id="password" name="password" maxlength="255"
        placeholder="{{ __('Пароль') }}">
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">{{ __('Пароль еще раз') }}</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" maxlength="255"
        placeholder="{{ __('Пароль еще раз') }}">
</div>

<div class="text-end">
    <button type="submit" class="btn btn-success">{{ __('Сохранить') }}</button>
</div>
