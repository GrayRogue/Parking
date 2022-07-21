<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertCarsRequest extends FormRequest
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
            'New_Gos' => 'required|between:6,6',
            'New_Marks' => 'required',
            'New_Model' => 'required',
            'New_Color' => 'required'
          ];
      }

      public function messages()
      {
        return [
          'New_Gos.required' => 'Поле ввода гос. номера Вашего автомобиля является обязательным для заполнения.',
          'New_Marks.required' => 'Поле ввода марки автомобиля является обязательным для заполнения.',
          'New_Color.required' => 'Поле ввода цвета кузова автомобиля является обязательным для заполнения.',
          'New_Model.required' => 'Поле ввода модели автомобиля является обязательным для заполнения.',
          'New_Gos.required' => 'Поле ввода цвета кузова автомобиля является обязательным для заполнения.',
          'New_Gos.between' => 'Поле ввода гос. номера Вашего автомобиля не должно быть короче восьми символов.'
        ];
      }
}
