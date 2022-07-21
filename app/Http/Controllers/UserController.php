<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditPersonalRequest;
use App\Http\Requests\EditCarsRequest;
use App\Http\Requests\InsertCarsRequest;
use Illuminate\Support\Facades\DB;
use App\Models\parks;
use App\Models\cars;

class UserController extends Controller
{
    public function allData()
    {
      $Parks = DB::table('parks')
            ->join('cars', 'parks.Cars', '=', 'cars.Gos_Num')
            ->select('parks.id', 'parks.FIO','cars.Marks','cars.Model', 'cars.Gos_Num')
            ->paginate(3);

      $Cars = DB::table('cars')->where('State', 1)->paginate(3);
      return view('allUsers', ['data' => $Parks, 'data2' => $Cars]);
    }

    public function EditData($id)
    {
      $Parks = DB::table('parks');
      $Cars = DB::table('parks')
            ->join('cars', 'parks.Cars', '=', 'cars.Gos_Num')
            ->select('parks.id', 'cars.id', 'parks.FIO','cars.Marks','cars.Model', 'cars.Gos_Num', 'cars.Color', 'cars.State')
            ->paginate(3);
      return view('Editing', ['data' => $Parks->find($id), 'data2'=>$Cars]);
    }

    public function EditPersonalData($id, EditPersonalRequest $req)
    {
      $edit_personal = new parks();
      $edit_personal->Phone = $req->input('Phone');
      DB::table('parks')->where('FIO', $_GET["FIO"])->update(['Phone'=>$_GET['Phone'], 'Adres'=>$_GET['Adres']]);
      return redirect()->route('Contact-form')->with('success', 'Персональные данные успешно обновлены!');
    }

    public function EditCarslData($id)
    {
      $Cars = DB::table('cars')->get();
      $Parks = DB::table('parks')->find($id);
      foreach ($Cars as $Car)
      {
        if (isset($_GET['Change'.$Car->id]) && $_GET['Change'.$Car->id] == 'Да' && isset($_GET['State'.$Car->id]) && $_GET['State'.$Car->id] == 'Да')
        {
          if(isset($_GET['Color'.$Car->id]) && strlen($_GET['Color'.$Car->id]) == 0)
          {
            return redirect()->route('Contact-form')->with('success', 'Поле ввода цвета кузова автомобиля не может быть пустым!');
            die();
          }
          else
          {
            $NewColor = $_GET['Color'.$Car->id];
            DB::table('cars')->where('id', $Car->id)->update(['Color'=>$NewColor,'State'=>1, 'updated_at'=>date("y-m-d")]);
          }
        }
        if (isset($_GET['Change'.$Car->id]) && $_GET['Change'.$Car->id] == 'Да' && !isset($_GET['State'.$Car->id]))
        {
          if(isset($_GET['Color'.$Car->id]) && strlen($_GET['Color'.$Car->id]) == 0)
          {
            return redirect()->route('Contact-form')->with('success', 'Поле ввода цвета кузова автомобиля не может быть пустым!');
            die();
          }
          else
          {
            $NewColor = $_GET['Color'.$Car->id];
            DB::table('cars')->where('id', $Car->id)->update(['Color'=>$NewColor, 'State'=>0, 'updated_at'=>date("y-m-d")]);
          }
        }
      }
      return redirect()->route('Contact-form')->with('success', 'Обновление успешно завершено!');
    }

    public function InsertCarslData ($id, InsertCarsRequest $req)
    {
      $new_cars = new cars();
      $new_cars->Gos_Num = $req->input('New_Gos');

      $Cars = $new_cars->Gos_Num.' '.$_GET['region'];
      $Sravnenies = DB::table('cars')->get();
      foreach ($Sravnenies as $Sravnenie)
      {
        if($Sravnenie->Gos_Num == $Cars)
        {
          return redirect()->route('Contact-form')->with('success', 'Такой гос. номер уже был добавлен в базу данных!');
          die();
        }
      }
      $Client_datas = DB::table('parks')->where('id', $id)->get();
      foreach ($Client_datas as $Client_data)
      {
        DB::table('parks')->insert(['FIO'=>$Client_data->FIO, 'Sex'=>$Client_data->Sex, 'Phone'=>$Client_data->Phone, 'Adres'=>$Client_data->Adres, 'Cars'=>$Cars, 'updated_at'=>date("y-m-d"), 'created_at'=>date("y-m-d")]);
      }

      $creation2 = new cars();
      $creation2->Marks = $req->input('Marks');
      $creation2->Model = $req->input('Model');
      $creation2->Color = $req->input('Color');
      $creation2->Gos_Num = $req->input('Cars');
      if(isset($_GET['New_State']) && $_GET['New_State'] == 'Да')
      {
        $creation2->State = true;
        DB::table('cars')->insert(['Marks'=>$_GET['New_Marks'], 'Model'=>$_GET['New_Model'], 'Color'=>$_GET['New_Color'], 'Gos_Num'=>$Cars,'State'=>$creation2->State, 'updated_at'=>date("y-m-d"), 'created_at'=>date("y-m-d")]);
      }
      else
      {
        $creation2->State = false;
        DB::table('cars')->insert(['Marks'=>$_GET['New_Marks'], 'Model'=>$_GET['New_Model'], 'Color'=>$_GET['New_Color'], 'Gos_Num'=>$Cars, 'State'=>$creation2->State, 'updated_at'=>date("y-m-d"), 'created_at'=>date("y-m-d")]);
      }

      return redirect()->route('home')->with('success', 'Автомобиль успешно добавлен в базу данных!');
    }

    public function deleteData($id)
    {
      $Parks = DB::table('parks')->where('id', $id)->delete();
      return redirect()->route('Contact-form')->with('success', 'Запись успешно удалена!');
    }

    public function state_delete($id)
    {
      $Cars = DB::table('cars')->where('id', $id)->update(['State' => 0]);
      return redirect()->route('Contact-form')->with('success', 'Автомобиль успешно снят с парковки!');
    }
}
