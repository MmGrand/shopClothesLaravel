@csrf
<div class="mb-3">
    <label for="name" class="form-label">{{ __('Наименование') }}</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Наименование" required
        maxlength="100" value="{{ old('name') ?? ($brand->name ?? '') }}">
</div>
<div class="mb-3">
    <label for="slug" class="form-label">{{ __('ЧПУ (на англ.)') }}</label>
    <input type="text" class="form-control" id="slug" name="slug" placeholder="ЧПУ (на англ.)" required
        maxlength="100" value="{{ old('slug') ?? ($brand->slug ?? '') }}">
</div>
<div class="mb-3">
    <label for="content" class="form-label">{{ __('Краткое описание') }}</label>
    <textarea class="form-control" id="content" name="content" placeholder="Краткое описание" maxlength="200"
        rows="3">{{ old('content') ?? ($brand->content ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label for="image" class="form-label">{{ __('Загрузить изображение') }}</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg">
</div>
@isset($brand->image)
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="remove" name="remove">
        <label class="form-check-label" for="remove">{{ __('Удалить загруженное изображение') }}</label>
    </div>
@endisset
<div class="text-end">
    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
</div>
