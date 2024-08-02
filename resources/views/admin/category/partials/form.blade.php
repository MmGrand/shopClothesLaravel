@csrf
<div class="mb-3">
    <input type="text" class="form-control" name="name" placeholder="Наименование" required maxlength="100"
        value="{{ old('name') ?? ($category->name ?? '') }}">
</div>
<div class="mb-3">
    <input type="text" class="form-control" name="slug" placeholder="ЧПУ (на англ.)" required maxlength="100"
        value="{{ old('slug') ?? ($category->slug ?? '') }}">
</div>
<div class="mb-3">
    @php
        $parent_id = old('parent_id') ?? ($category->parent_id ?? 0);
    @endphp
    <select name="parent_id" class="form-control" title="Родитель">
        <option value="0">{{ __('Без родителя') }}</option>
        @if (count($items))
            @include('admin.category.partials.branch', ['level' => -1, 'parent' => 0])
        @endif
    </select>
</div>
<div class="mb-3">
    <textarea class="form-control" name="content" placeholder="Краткое описание" maxlength="200" rows="3">{{ old('content') ?? ($category->content ?? '') }}</textarea>
</div>
<div class="mb-3">
    <input type="file" class="form-control-file" name="image" accept="image/png, image/jpeg">
</div>
@isset($category->image)
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="remove" id="remove">
        <label class="form-check-label" for="remove">{{ __('Удалить загруженное изображение') }}</label>
    </div>
@endisset
<div class="mb-3">
    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
</div>
