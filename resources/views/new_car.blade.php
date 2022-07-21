@extends('layouts.app')

@section('title')Страница добавления автомобиля@endsection

@section('content')
 <h1>Клиент - {{$data->FIO}}</h1>

 <form action="{{ route('new-form, $data->id') }}" method="post">
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <h3>Добавить новый автотранспорт</h3>
     <label for="New_Gos">Введите гос. номер вашего автомобиля</label>
     <input type="text" name="New_Gos" placeholder="О232ХР 34" id="New_Gos" class="form-control">
   </div>
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <label for="New_Marks">Введите марку вашего автомобиля</label>
     <input type="text" name="New_Marks" placeholder="Opel" id="New_Marks" class="form-control">
   </div>
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <label for="New_Model">Введите модель вашего автомобиля</label>
     <input type="text" name="New_Model" placeholder="Astra" id="New_Model" class="form-control">
   </div>
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <label for="New_Color">Введите цвет кузова вашего автомобиля</label>
     <input type="text" name="New_Color" placeholder="Красный" id="New_Color" class="form-control">
   </div>
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <label for="New_State">Установить автомобиль на парковку?</label>
     <input type="checkbox" name="New_State" id="New_State" value="Да">
   </div>
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <br><button type="submit" class="btn btn-success">Добавить автомобиль</button>
   </div>
 </form>
@endsection
