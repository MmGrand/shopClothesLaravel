<?php

namespace App\Http\Requests\Admin\Order;

use App\Models\Order;
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
            'status' => [
                'required',
                'integer',
                'in:' . implode(',', array_keys(Order::STATUSES))
            ],
            'user_id' => [
                'nullable',
                'integer',
                'min:1',
                'exists:users,id'
            ],
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'email' => [
                'required',
                'string',
                'email'
            ],
            'phone' => [
                'required',
                'string'
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
            ],
            'amount' => [
                'required',
                'numeric',
                'min:1'
            ]
        ];
    }
}
