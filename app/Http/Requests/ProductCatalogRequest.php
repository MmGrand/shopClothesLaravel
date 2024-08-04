<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCatalogRequest extends CatalogRequest
{
    protected $entity = [
        'name' => 'product',
        'table' => 'products'
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

    protected function createItem() {
        $rules = [
            'category_id' => [
                'required',
                'integer',
                'min:1',
                'exists:categories,id'
            ],
            'brand_id' => [
                'required',
                'integer',
                'min:1',
                'exists:brands,id'
            ],
            'price' => [
                'nullable',
                'numeric',
                'min:0'
            ],
            'is_published' => [
                'nullable',
                'boolean'
            ],
            'views_count' => [
                'nullable',
                'integer'
            ]
        ];
        return array_merge(parent::createItem(), $rules);
    }

    protected function updateItem() {
        $rules = [
            'category_id' => [
                'required',
                'integer',
                'min:1'
            ],
            'brand_id' => [
                'required',
                'integer',
                'min:1'
            ],
            'price' => [
                'nullable',
                'numeric',
                'min:0'
            ],
            'is_published' => [
                'nullable',
                'boolean'
            ],
            'views_count' => [
                'nullable',
                'integer'
            ]
        ];
        return array_merge(parent::updateItem(), $rules);
    }
}
