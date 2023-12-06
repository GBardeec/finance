<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => ['string', 'required','max:25','min:3'],
            'password' => ['string', 'required','max:25','min:3'],
        ];
    }

    public function messages()
    {
        return [
            'login.string' => 'Поле логин должно быть строковым значением',
            'login.required' => 'Поле логин необходимо заполнить',
            'login.max' => 'Максимальное значение логина не должно превышать 25 символов',
            'login.min' => 'Минимальное значение логина составляет 3 символа',
            'password.string' => 'Поле пароль должно быть строковым значением',
            'password.required' => 'Поле пароль необходимо заполнить',
            'password.max' => 'Максимальное значение пароля не должно превышать 25 символов',
            'password.min' => 'Минимальное значение пароля составляет 3 символа',
        ];
    }

}
