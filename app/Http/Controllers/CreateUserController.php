<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use App\Models\parks;
use App\Models\cars;
use Illuminate\Support\Facades\DB;

class CreateUserController extends Controller
{
  public function submit(CreateRequest $req)
  {
    $creation = new parks();
    $creation->FIO = $req->input('FIO');
    $creation->Sex = $req->input('Sex');
    $creation->Phone = $req->input('Phone');
    $creation->Cars = $req->input('Cars');

    $Cars = $creation->Cars.' '.$_POST['region'];
    $Sravnenies = DB::table('parks')->get();
    foreach ($Sravnenies as $Sravnenie)
    {
      if($Sravnenie->Cars == $Cars)
      {
        return redirect()->route('Creation')->with('success', 'Такой гос. номер уже был добавлен в базу данных!');
        die();
      }
    }

    DB::table('parks')->insert(['FIO'=>$_POST['FIO'], 'Sex'=>$_POST['Sex'], 'Phone'=>$_POST['Phone'], 'Adres'=>$_POST['Adres'], 'Cars'=>$Cars, 'updated_at'=>date("y-m-d"), 'created_at'=>date("y-m-d")]);

    $creation2 = new cars();
    $creation2->Marks = $req->input('Marks');
    $creation2->Model = $req->input('Model');
    $creation2->Color = $req->input('Color');
    $creation2->Gos_Num = $req->input('Cars');
    if(isset($_POST['State']) && $_POST['State'] == 'Да')
    {
      $creation2->State = true;
      DB::table('cars')->insert(['Marks'=>$_POST['Marks'], 'Model'=>$_POST['Model'], 'Color'=>$_POST['Color'], 'Gos_Num'=>$Cars,'State'=>$creation2->State, 'updated_at'=>date("y-m-d"), 'created_at'=>date("y-m-d")]);
    }
    else
    {
      $creation2->State = false;
      DB::table('cars')->insert(['Marks'=>$_POST['Marks'], 'Model'=>$_POST['Model'], 'Color'=>$_POST['Color'], 'Gos_Num'=>$Cars, 'State'=>$creation2->State, 'updated_at'=>date("y-m-d"), 'created_at'=>date("y-m-d")]);
    }

    return redirect()->route('home')->with('success', 'Клиент парковки успешно добавлен в базу данных!');
  }
}
