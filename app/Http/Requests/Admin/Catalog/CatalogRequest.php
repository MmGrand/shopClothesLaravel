<?php

namespace App\Http\Requests\Admin\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class CatalogRequest extends FormRequest
{
    protected $entity = [];
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                return $this->createItem();
            case 'PUT':
            case 'PATCH':
                return $this->updateItem();
        }
    }

    protected function createItem()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'slug' => [
                'required',
                'max:100',
                'unique:'.$this->entity['table'].',slug',
                'regex:~^[-_a-z0-9]+$~i',
            ],
            'content' => [
                'nullable',
                'string',
                'max:500'
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png',
                'max:5000'
            ],
        ];
    }

    protected function updateItem()
    {
        // получаем объект модели из маршрута: admin/entity/{entity}
        $model = $this->route($this->entity['name']);
        return [
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'slug' => [
                'required',
                'max:100',
                // проверка на уникальность slug, исключая эту сущность по идентифкатору
                'unique:'.$this->entity['table'].',slug,'.$model->id.',id',
                'regex:~^[-_a-z0-9]+$~i',
            ],
            'content' => [
                'nullable',
                'string',
                'max:500'
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png',
                'max:5000'
            ],
        ];
    }
}
