<?php

namespace App\Http\Requests\Admin;

class BrandCatalogRequest extends CatalogRequest
{
    protected $entity = [
        'name' => 'brand',
        'table' => 'brands'
    ];
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return parent::rules();
    }

    protected function createItem()
    {
        $rules = [];
        return array_merge(parent::createItem(), $rules);
    }

    protected function updateItem() {
        $rules = [];
        return array_merge(parent::updateItem(), $rules);
    }
}
