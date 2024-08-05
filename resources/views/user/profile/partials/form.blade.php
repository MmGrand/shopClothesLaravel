@csrf
<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
<div class="mb-3">
    <input type="text" class="form-control" name="title" placeholder="Название профиля"
           required maxlength="255" value="{{ old('title') ?? $profile->title ?? '' }}">
</div>
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
    <button type="submit" class="btn btn-success">{{ __('Сохранить') }}</button>
</div>