<?php

namespace App\Http\Requests\Income;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => ['numeric', 'required', 'between:1,10000000'],
            'selectedCategory' => ['integer', 'required'],
        ];
    }

    public function messages()
    {
        return [
            'value.numeric' => 'Это поле должно быть числом',
            'value.required' => 'Поле с суммой необходимо заполнить',
            'value.between' => 'Максимальное значение для этого поля не должно превышать 10 миллионов',
            'selectedCategory.integer' => 'Выберите корректную категорию',
            'selectedCategory.required' => 'Поле с категориями необходимо для заполнения',
        ];
    }


}
