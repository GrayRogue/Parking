<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\parks;

class CreateRequest extends FormRequest
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
            'FIO' => 'required|between:3,100',
            'Phone' => 'required|between:10,10|unique:parks,Phone',
            'Cars' => 'required|between:6,6',
            'Marks' => 'required',
            'Model' => 'required',
            'Color' => 'required'
        ];
    }

    public function messages()
    {
      return [
        'FIO.required' => 'Поле ввода ФИО является обязательным для заполнения.',
        'Phone.required' => 'Поле ввода Вашего номера телефона является обязательным для заполнения.',
        'Cars.required' => 'Поле ввода гос. номера Вашего автомобиля является обязательным для заполнения.',
        'Marks.required' => 'Поле ввода марки автомобиля является обязательным для заполнения.',
        'Model.required' => 'Поле ввода модели автомобиля является обязательным для заполнения.',
        'Color.required' => 'Поле ввода цвета кузова автомобиля является обязательным для заполнения.',
        'FIO.between' => 'Поле ввода ФИО не должно быть короче трех символов.',
        'Cars.between' => 'Поле ввода гос. номера Вашего автомобиля не должно быть короче шести символов.',
        'Phone.between' => 'Поле ввода Вашего номера телефона не должно быть короче десяти цифр.',
        'Phone.unique' => 'Такой номер телефона уже зарегистрирован в базе данных. Пожалуйста, введите другой номер телефона.'
      ];
    }
}
