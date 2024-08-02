<?php

namespace App\Http\Requests;

use App\Rules\CategoryParent;

class CategoryCatalogRequest extends CatalogRequest
{
    protected $entity = [
        'name' => 'category',
        'table' => 'categories'
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
        $rules = [
            'parent_id' => [
                'required',
                'integer',
                'regex:~^[0-9]+$~',
            ],
        ];
        return array_merge(parent::createItem(), $rules);
    }

    protected function updateItem() {
        $model = $this->route('category');
        $rules = [
            'parent_id' => [
                'required',
                'integer',
                'regex:~^[0-9]+$~',
                new CategoryParent($model)
            ],
        ];
        return array_merge(parent::updateItem(), $rules);
    }
}
