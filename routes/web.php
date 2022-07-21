<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateUserController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home/all', function () {
    return view('allUsers');
})->name('home/all');

Route::get('/Creation', function () {
    return view('Creation');
})->name('Creation');

Route::get('/home/all', 'UserController@allData')->name('Contact-form');
Route::get('/home/all{id}/editing', 'UserController@state_delete')->name('state-delete-form');
Route::get('/home/all/{id}/editing', 'UserController@EditData')->name('Edit-form');
Route::get('/home/all/{id}/delete', 'UserController@deleteData')->name('delete-form');
Route::get('/home/all/{id}/editing_personal', 'UserController@EditPersonalData')->name('edit-personal-form');
Route::get('/home/all/{id}/editing_cars', 'UserController@EditCarslData')->name('edit-cars-form');
Route::get('/home/all/{id}new_cars', 'UserController@InsertCarslData')->name('new_cars-form');
Route::post('/Creation/submit', 'CreateUserController@submit')->name('Creation-form');
