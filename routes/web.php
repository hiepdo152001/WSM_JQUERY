<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});
Route::get('/home/register', function () {
    return view('welcome');
});

Route::get('/home/calendar', function () {
    return view('welcome');
});
Route::get('/home/user', function () {
    return view('welcome');
});
Route::get('/home/department', function () {
    return view('welcome');
});
Route::get('/home/member', function () {
    return view('welcome');
});
Route::get('/home/edit/profile', function () {
    return view('welcome');
});
Route::get('/home/request', function () {
    return view('welcome');
});
Route::get('/home/request/new', function () {
    return view('welcome');
});

Route::get('home/department/new', function () {
    return view('welcome');
});
Route::get('/home/member/request', function () {
    return view('welcome');
});
