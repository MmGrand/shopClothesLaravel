@props(['entity', 'routeName', 'routeParam'])

<form method="get" action="{{ route($routeName, [$routeParam => $entity->slug]) }}">
    <select name="price" class="form-control d-inline w-25 me-4" title="Цена">
        <option value="0">{{ __('Выберите цену') }}</option>
        <option value="min"@if (request()->price == 'min') selected @endif>{{ __('Сначала дешевые товары') }}
        </option>
        <option value="max"@if (request()->price == 'max') selected @endif>{{ __('Сначала дорогие товары') }}
        </option>
    </select>
    <!-- новинка -->
    <div class="form-check form-check-inline">
        <input type="checkbox" name="new" class="form-check-input" id="new-product"
            @if (request()->has('new')) checked @endif value="yes">
        <label class="form-check-label" for="new-product">{{ __('Новинка') }}</label>
    </div>
    <!-- лидер продаж -->
    <div class="form-check form-check-inline">
        <input type="checkbox" name="hit" class="form-check-input" id="hit-product"
            @if (request()->has('hit')) checked @endif value="yes">
        <label class="form-check-label" for="hit-product">{{ __('Лидер продаж') }}</label>
    </div>
    <!-- распродажа -->
    <div class="form-check form-check-inline ">
        <input type="checkbox" name="sale" class="form-check-input" id="sale-product"
            @if (request()->has('sale')) checked @endif value="yes">
        <label class="form-check-label" for="sale-product">{{ __('Распродажа') }}</label>
    </div>
    <button type="submit" class="btn btn-light me-1">{{ __('Фильтровать') }}</button>
    <a href="{{ route($routeName, [$routeParam => $entity->slug]) }}"
        class="btn btn-light">{{ __('Сбросить') }}</a>
</form>
