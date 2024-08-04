@csrf
<div class="mb-3">
    <input type="text" class="form-control" name="name" placeholder="Наименование"
           required maxlength="100" value="{{ old('name') ?? $product->name ?? '' }}">
</div>
<div class="mb-3">
    <input type="text" class="form-control" name="slug" placeholder="ЧПУ (на англ.)"
           required maxlength="100" value="{{ old('slug') ?? $product->slug ?? '' }}">
</div>
<div class="mb-3">
    <input type="number" class="form-control" name="price" placeholder="Цена" value="{{ old('price') ?? $product->price ?? '' }}">
</div>
<div class="mb-3">
    @php
        $category_id = old('category_id') ?? $product->category_id ?? 0;
    @endphp
    <select name="category_id" class="form-control" title="Категория">
        <option value="0" selected disabled>{{ __('Выберите категорию') }}</option>
        @if (count($items))
            @include('admin.product.partials.branch', ['level' => -1, 'parent' => 0])
        @endif
    </select>
</div>
<div class="mb-3">
    @php
        $brand_id = old('brand_id') ?? $product->brand_id ?? 0;
    @endphp
    <select name="brand_id" class="form-control" title="Бренд">
        <option value="0" selected disabled>{{ __('Выберите бренд') }}</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" @if ($brand->id == $brand_id) selected @endif>
                {{ $brand->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <textarea class="form-control" name="content" placeholder="Описание"
              rows="4">{{ old('content') ?? $product->content ?? '' }}</textarea>
</div>
<div class="mb-3">
    <input type="file" class="form-control-file" name="image" accept="image/png, image/jpeg">
</div>
@isset($product->image)
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="remove" id="remove">
        <label class="form-check-label" for="remove">
            {{ __('Удалить загруженное изображение') }}
        </label>
    </div>
@endisset
<div class="mb-3">
    <input type="number" class="form-control" name="views_count" placeholder="Количество просмотров" value="{{ old('views_count') ?? $product->views_count ?? '' }}">
</div>
<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" name="is_published" id="is_published" value="{{ old('is_published') ?? $product->is_published ?? '' }}">
    <label class="form-check-label" for="is_published">
        {{ __('Опубликован') }}
    </label>
</div>
<div class="mb-3">
    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
</div>
