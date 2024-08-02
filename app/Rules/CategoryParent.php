<?php

namespace App\Rules;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CategoryParent implements ValidationRule
{
    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->category->validParent($value)) {
            $fail('Категорию нельзя поместить внутрь самой себя');
        }
    }
}
