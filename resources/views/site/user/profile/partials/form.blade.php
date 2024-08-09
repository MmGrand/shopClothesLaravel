<form method="post" action="{{ route('user.profile.store') }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

    <div class="mb-3">
        <label for="title" class="form-label">{{ __('Название профиля') }}</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Название профиля" required
            maxlength="255" value="{{ old('title') ?? ($profile->title ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Имя, Фамилия') }}</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Имя, Фамилия" required
            maxlength="255" value="{{ old('name') ?? ($profile->name ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Адрес почты') }}</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Адрес почты" required
            maxlength="255" value="{{ old('email') ?? ($profile->email ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">{{ __('Номер телефона') }}</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Номер телефона" required
            maxlength="255" value="{{ old('phone') ?? ($profile->phone ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">{{ __('Адрес доставки') }}</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Адрес доставки" required
            maxlength="255" value="{{ old('address') ?? ($profile->address ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="comment" class="form-label">{{ __('Комментарий') }}</label>
        <textarea class="form-control" id="comment" name="comment" placeholder="Комментарий" maxlength="255" rows="2">{{ old('comment') ?? ($profile->comment ?? '') }}</textarea>
    </div>

    <div class="mb-3 text-end">
        <button type="submit" class="btn btn-success">{{ __('Сохранить') }}</button>
    </div>
</form>
