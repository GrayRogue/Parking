@extends('layouts.app')

@section('title')Страница редактирования клиента парковки@endsection

@section('content')
<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
  $('body').on('input', '.Phone', function(){
    this.value = this.value.replace(/[^0-9]/g, '');
    let val_tel = $(this).val();
    if(val_tel.substr(0,3) >= 900 && val_tel.substr(0,3) <= 999)
    {
      $(this).css('color', 'green');
      document.getElementById("MyButton").disabled = false;
    }
    if(val_tel.substr(0,3) < 900)
    {
      document.getElementById("MyButton").disabled = true;
    }
  });

  $('body').on('input', '.New_Gos', function(){ // вешаем обработчик на инпут
  let val = $(this).val(); // получаем значение в переменную
  if(val.length === 6) { // нам нужно, чтобы значение было шесть символов в длину
    if(val.match(/^(а|в|е|к|м|н|о|р|с|т|у|х){1}[0-9]{3}(а|в|е|к|м|н|о|р|с|т|у|х){2}$/gi)) { // запускаем проверку по нашей регулярке
      $(this).css('color', 'green'); // красим текст инпута в зелёный, если это гос. номер по ГОСТу
      document.getElementById("MyButton2").disabled = false;
    } else {
      $(this).css('color', 'darkred'); // красим текст в красный, если нет
      document.getElementById("MyButton2").disabled = true;
      alert('Гос. номер введен некорректно');
    }
  }
});
</script>

 <h1>Клиент - {{$data->FIO}}</h1>

   @csrf

   <form method="get" action="{{ route('edit-personal-form', $data->id) }}"><div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <label for="FIO">Ваше ФИО</label>
     <input type="text" name="FIO" value="{{$data->FIO}}" readonly placeholder="Иванов Иван Иванович" id="FIO" class="form-control">
   </div>
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <label for="Sex">Ваш пол</label>
     <input type="text" name="Sex" value="{{$data->Sex}}" readonly placeholder="Муж/Жен" id="Sex" class="form-control">
   </div>
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <label for="Phone">Ваш номер телефона</label>
     <input type="text" value="{{$data->Phone}}" name="Phone" maxlength="10" placeholder="9052691544" id="Phone" class="Phone form-control">
   </div>
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <label for="Adres">Ваш адрес проживания</label>
     <input type="text" value="{{$data->Adres}}" name="Adres" placeholder="Московская область, город Зарайск, пл. Чехова, 71" id="Adres" class="form-control">
     <br>
     <a href="{{ route('edit-personal-form', $data->id) }}"><button type="submit" id="MyButton" class="btn btn-success">Обновить персональные данные</button></a>
   </div></form>
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <br><h3>Данные вашего личного автотранспорта</h3>
   </div>
   @foreach ($data2 as $el)
     <form method="get" action="{{ route('edit-cars-form', $data->id) }}"><div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
       <label for="Change">Выбрать автомобиль для изменения параметров (Не более 1 автомобиля за раз) <input type="checkbox" name="Change{{$el->id}}" value="Да" id="{{$el->id}}"></label><br>
       <label for="Marks">Марка вашего автомобиля</label>
       <input type="text" name="Marks" value="{{$el->Marks}}" readonly placeholder="Opel" id="Marks" class="form-control">
     </div>
     <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
       <label for="Model">Модель вашего автомобиля</label>
       <input type="text" name="Model" value="{{$el->Model}}" readonly placeholder="Astra" id="Model" class="form-control">
     </div>
     <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
       <label for="Color">Цвет кузова вашего автомобиля</label>
       <input type="text" name="Color{{$el->id}}" value="{{$el->Color}}" placeholder="Зеленый" id="Color{{$el->id}}" class="form-control">
     </div>
     <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
        <label for="Gos_Num">Гос. номер вашего автомобиля</label>
        <input type="text" name="Gos_Num{{$el->id}}" value="{{$el->Gos_Num}}" readonly placeholder="О232ХР 34" id="Gos_Num{{$el->id}}" class="form-control">
     </div>
     <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
       @if ($el->State === 0)
          <label for="State">Автомобиль не стоит на стоянке. Поставить его? <input type="checkbox" name="State{{$el->id}}" value="Да" id="{{$el->id}}"></label>
       @endif
     <hr></div>
   @endforeach
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <a href="{{ route('edit-cars-form', $data->id) }}"><button type="submit" id="MyButton" class="btn btn-success">Обновить данные автотранспорта</button></a>
   </div><br>
 </form>

    <form method="get" action="{{ route('new_cars-form', $data->id) }}">
      <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <h3>Добавить новый автотранспорт</h3>
     <label for="New_Gos">Введите гос. номер вашего автомобиля</label>
     <input type="text" name="New_Gos" maxlength="6" placeholder="А232АА"  id="New_Gos" class="New_Gos">
     <select name="region" id="input-select">
       <option value="1">Республика Адыгея</option>
       <option value="2">Республика Алтай </option>
       <option value="3">Республика Башкортостан </option>
       <option value="4">Республика Бурятия </option>
       <option value="5">Республика Дагестан </option>
       <option value="6">Республика Ингушетия </option>
       <option value="7">Кабардино-Балкарская Республика</option>
       <option value="8">Республика Калмыкия </option>
       <option value="9">Карачаево-Черкесская Республика</option>
       <option value="10">Республика Карелия </option>
       <option value="11">Республика Коми </option>
       <option value="12">Республика Марий Эл </option>
       <option value="13">Республика Мордовия </option>
       <option value="14">Республика Саха (Якутия) </option>
       <option value="15">Республика Северная Осетия - Алания </option>
       <option value="16">Республика Татарстан</option>
       <option value="17">Республика Тыва </option>
       <option value="18">Удмуртская Республика </option>
       <option value="19">Республика Хакасия </option>
       <option value="20">Чеченская Республика</option>
       <option value="21">Чувашская Республика</option>
       <option value="22">Алтайский край</option>
       <option value="75">Забайкальский край</option>
       <option value="41">Камчатский край</option>
       <option value="23">Краснодарский край</option>
       <option value="24">Красноярский край</option>
       <option value="59">Пермский край</option>
       <option value="25">Приморский край</option>
       <option value="26">Ставропольский край</option>
       <option value="27">Хабаровский край</option>
       <option value="28">Амурская область </option>
       <option value="29">Архангельская область</option>
       <option value="30">Астраханская область </option>
       <option value="31">Белгородская область</option>
       <option value="32">Брянская область </option>
       <option value="33">Владимирская область </option>
       <option value="34">Волгоградская область </option>
       <option value="35">Вологодская область </option>
       <option value="36">Воронежская область </option>
       <option value="37">Ивановская область </option>
       <option value="38">Иркутская область </option>
       <option value="39">Калининградская область</option>
       <option value="40">Калужская область </option>
       <option value="42">Кемеровская область </option>
       <option value="43">Кировская область </option>
       <option value="44">Костромская область </option>
       <option value="45">Курганская область </option>
       <option value="46">Курская область </option>
       <option value="47">Ленинградская область </option>
       <option value="48">Липецкая область </option>
       <option value="49">Магаданская область</option>
       <option value="50">Московская область </option>
       <option value="51">Мурманская область </option>
       <option value="52">Нижегородская область </option>
       <option value="53">Новгородская область </option>
       <option value="54">Новосибирская область </option>
       <option value="55">Омская область</option>
       <option value="56">Оренбургская область </option>
       <option value="57">Орловская область </option>
       <option value="58">Пензенская область </option>
       <option value="60">Псковская область </option>
       <option value="61">Ростовская область </option>
       <option value="62">Рязанская область </option>
       <option value="63">Самарская область </option>
       <option value="64">Саратовская область </option>
       <option value="65">Сахалинская область </option>
       <option value="66">Свердловская область </option>
       <option value="67">Смоленская область </option>
       <option value="68">Тамбовская область </option>
       <option value="69">Тверская область </option>
       <option value="70">Томская область </option>
       <option value="71">Тульская область</option>
       <option value="72">Тюменская область </option>
       <option value="73">Ульяновская область </option>
       <option value="74">Челябинская область </option>
       <option value="76">Ярославская область</option>
       <option value="77">Москва</option>
       <option value="78">Санкт-Петербург</option>
       <option value="79">Еврейская АО</option>
       <option value="80">Ненецкий АО</option>
       <option value="81">Ханты-Мансийский АО</option>
       <option value="82">Чукотский АО</option>
       <option value="83">Ямало-Ненецкий АО</option>
     </select>
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
     <input type="text" name="New_Color" placeholder="Красный" pattern="[А-Яа-яЁё ]+" id="New_Color" class="form-control">
   </div>
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <label for="New_State">Установить автомобиль на парковку?</label>
     <input type="checkbox" name="New_State" id="New_State" value="Да">
   </div>
   <div class="form-group" style="width: 80%; margin-left: auto; margin-right: auto;">
     <br>
     <a href="{{ route('new_cars-form', $data->id) }}"><button type="submit" id="MyButton2" class="btn btn-success">Добавить автомобиль</button></a>
   </div></form>

@endsection
