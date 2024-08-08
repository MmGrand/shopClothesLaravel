@csrf
<div class="mb-3">
    <label for="name" class="form-label">{{ __('Наименование') }}</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Наименование" required
        maxlength="100" value="{{ old('name') ?? ($category->name ?? '') }}">
</div>
<div class="mb-3">
    <label for="slug" class="form-label">{{ __('ЧПУ (на англ.)') }}</label>
    <input type="text" class="form-control" id="slug" name="slug" placeholder="ЧПУ (на англ.)" required
        maxlength="100" value="{{ old('slug') ?? ($category->slug ?? '') }}">
</div>
<div class="mb-3">
    <label for="parent_id" class="form-label">{{ __('Родитель') }}</label>
    @php
        $parent_id = old('parent_id') ?? ($category->parent_id ?? 0);
    @endphp
    <select name="parent_id" id="parent_id" class="form-control">
        <option value="0">{{ __('Без родителя') }}</option>
        @if (count($items))
            @include('admin.category.partials.branch', ['level' => -1, 'parent' => 0])
        @endif
    </select>
</div>
<div class="mb-3">
    <label for="content" class="form-label">{{ __('Краткое описание') }}</label>
    <textarea class="form-control" id="content" name="content" placeholder="Краткое описание" maxlength="200"
        rows="3">{{ old('content') ?? ($category->content ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label for="image" class="form-label">{{ __('Загрузить изображение') }}</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg">
</div>
@isset($category->image)
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remove" name="remove">
        <label class="form-check-label" for="remove">{{ __('Удалить загруженное изображение') }}</label>
    </div>
@endisset
<div class="mb-3 text-end">
    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
</div>
