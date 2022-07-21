<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\parks;

class EditPersonalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
     {
         return [
             'Phone' => 'required|between:10,10|unique:parks,Phone'
         ];
     }

     public function messages()
     {
       return [
         'Phone.required' => 'Поле ввода Вашего номера телефона является обязательным для заполнения.',
         'Phone.between' => 'Поле ввода Вашего номера телефона не должно быть короче десяти цифр.',
         'Phone.unique' => 'Такой номер телефона уже зарегистрирован в базе данных. Пожалуйста, введите другой номер телефона.'
       ];
     }
}
