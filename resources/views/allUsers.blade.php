@extends('layouts.app')

@section('title')Клиенты парковки@endsection

@section('content')

<div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <h1>Клиенты парковки</h1>
      <div><table class="table" style="width:80%; margin-left: auto; margin-right: auto;">
          <thead>
            <tr>
              <th scope="col">ФИО</th>
              <th scope="col">Автомобиль</th>
              <th scope="col">Гос. номер</th>
              <th scope="col">Действия</th>
            </tr>
          </thead>
          <tbody>
      @foreach ($data as $el)
              <tr>
                <td>{{$el->FIO}}</td>
                <td>{{$el->Marks}} {{$el->Model}}</td>
                <td>{{$el->Gos_Num}}</td>
                <td>
                  <a href="{{ route('delete-form', $el->id) }}"><button type="button" name="button">Удалить</button></a>
                  <a href="{{ route('Edit-form', $el->id) }}"><button type="button" name="button">Редактировать</button></a>
                </td>
              </tr>
      @endforeach
     </tbody>
     </table>
     <div style="margin-top:100px">
       {{ $data->links() }}
     </div>
     </div>
    </div>
    <div class="carousel-item">
      <h1>Автомобили на парковке</h1>
      <div><table class="table" style="width:80%; margin-left: auto; margin-right: auto;">
          <thead>
            <tr>
              <th scope="col">Марка</th>
              <th scope="col">Модель</th>
              <th scope="col">Цвет кузова</th>
              <th scope="col">Гос. номер</th>
              <th scope="col">Действие</th>
            </tr>
          </thead>
          <tbody>
      @foreach ($data2 as $el)
              <tr>
                <td>{{$el->Marks}}</td>
                <td>{{$el->Model}}</td>
                <td>{{$el->Color}}</td>
                <td>{{$el->Gos_Num}}</td>
                <td>
                  <a href="{{ route('state-delete-form', $el->id) }}"><button type="button" name="button">Снять со стоянки</button></a>
                </td>
              </tr>
      @endforeach
     </tbody>
     </table>
     <div style="margin-top:100px">
       {{ $data2->links() }}
     </div>
     </div>
    </div>
  </div>
  <button style="background: black; width: 5%; height: 50%; top:75px" class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Предыдущий</span>
  </button>
  <button style="background: black; width: 5%; height: 50%; top:75px"  class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Следующий</span>
  </button>
</div>
@endsection
