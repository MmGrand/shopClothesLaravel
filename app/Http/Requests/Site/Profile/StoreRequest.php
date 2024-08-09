<?php

namespace App\Http\Requests\Site\Profile;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
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
        return [
            'user_id' => [
                'in:' . auth()->user()->id,
            ],
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'email' => [
                'required',
                'email',
                'max:100'
            ],
            'phone' => [
                'required',
                'string',
                'max:100'
            ],
            'address' => [
                'required',
                'string',
                'max:255'
            ],
            'comment' => [
                'nullable',
                'string',
                'max:500'
            ]
        ];
    }
}
