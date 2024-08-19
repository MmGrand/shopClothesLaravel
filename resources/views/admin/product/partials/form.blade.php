@csrf
<div class="mb-3">
    <label for="name" class="form-label">{{ __('Наименование') }}</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Наименование') }}" required
        maxlength="100" value="{{ old('name') ?? ($product->name ?? '') }}">
</div>

<div class="mb-3">
    <label for="slug" class="form-label">{{ __('ЧПУ (на англ.)') }}</label>
    <input type="text" class="form-control" id="slug" name="slug" placeholder="{{ __('ЧПУ (на англ.)') }}" required
        maxlength="100" value="{{ old('slug') ?? ($product->slug ?? '') }}">
</div>

<div class="mb-3">
    <label for="price" class="form-label">{{ __('Цена') }}</label>
    <input type="number" class="form-control" id="price" name="price" placeholder="{{ __('Цена') }}"
        value="{{ old('price') ?? ($product->price ?? '') }}">
</div>

<div class="mb-3">
    <div class="form-check form-check-inline">
        @php $checked = old('new') ?? (isset($product) && $product->new) ? true : false; @endphp
        <input type="checkbox" name="new" class="form-check-input" id="new-product"
            @if ($checked) checked @endif value="1">
        <label class="form-check-label" for="new-product">{{ __('Новинка') }}</label>
    </div>
    <div class="form-check form-check-inline">
        @php $checked = old('hit') ?? (isset($product) && $product->hit) ? true : false; @endphp
        <input type="checkbox" name="hit" class="form-check-input" id="hit-product"
            @if ($checked) checked @endif value="1">
        <label class="form-check-label" for="hit-product">{{ __('Лидер продаж') }}</label>
    </div>
    <div class="form-check form-check-inline">
        @php $checked = old('sale') ?? (isset($product) && $product->sale) ? true : false; @endphp
        <input type="checkbox" name="sale" class="form-check-input" id="sale-product"
            @if ($checked) checked @endif value="1">
        <label class="form-check-label" for="sale-product">{{ __('Распродажа') }}</label>
    </div>
</div>

<div class="mb-3">
    @php
        $category_id = old('category_id') ?? ($product->category_id ?? 0);
    @endphp
    <label for="category_id" class="form-label">{{ __('Категория') }}</label>
    <select name="category_id" id="category_id" class="form-control">
        <option value="0" disabled>{{ __('Выберите категорию') }}</option>
        @if (count($items))
            @include('admin.product.partials.branch', ['level' => -1, 'parent' => 0])
        @endif
    </select>
</div>

<div class="mb-3">
    <label for="brand_id" class="form-label">{{ __('Бренд') }}</label>
    <select name="brand_id" id="brand_id" class="form-control">
        <option value="0" disabled>{{ __('Выберите бренд') }}</option>
        @foreach ($brands as $brand)
            <option value="{{ $brand->id }}" @if ($brand->id == (old('brand_id') ?? ($product->brand_id ?? ''))) selected @endif>
                {{ $brand->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="content" class="form-label">{{ __('Описание') }}</label>
    <textarea class="form-control" id="content" name="content" placeholder="{{ __('Описание') }}" rows="4">{{ old('content') ?? ($product->content ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="image" class="form-label">{{ __('Загрузить изображение') }}</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg">
</div>

@isset($product->image)
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remove" name="remove">
        <label class="form-check-label" for="remove">{{ __('Удалить загруженное изображение') }}</label>
    </div>
@endisset

<div class="mb-3">
    <label for="views_count" class="form-label">{{ __('Количество просмотров') }}</label>
    <input type="number" class="form-control" id="views_count" name="views_count" placeholder="{{ __('Количество просмотров') }}"
        value="{{ old('views_count') ?? ($product->views_count ?? '') }}">
</div>

<div class="mb-3 form-check">
    @php $checked = old('is_published') ?? (isset($product) && $product->is_published) ? true : false; @endphp
    <input type="checkbox" class="form-check-input" id="is_published" name="is_published"
        @if ($checked) checked @endif value="1">
    <label class="form-check-label" for="is_published">{{ __('Опубликован') }}</label>
</div>

<div class="text-end">
    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
</div>
</form>
