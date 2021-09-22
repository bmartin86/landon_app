<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentsController;
use App\Http\Controllers\ClientController;

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
    //return view('welcome');
    return '<h3>Landon App Page</h3>';
});

Route::get('/About', function () {
    $response_arr = [];
    $response_arr['author'] = 'BP';
    $response_arr['version'] = '0.1.1';
    return $response_arr;
    //return '<h3>About</h3>';
});


Route::get('/home', function () {
    $data = [];
    $data ['version'] = '0.1.1';
    return view('welcome', $data);
});


Route::get('/di', [ClientController::class, 'di']);

Route::get('/clients', [ClientController::class, 'index']);
Route::get('/clients/new', [ClientController::class, 'newClient']);
Route::post('/clients/new', [ClientController::class, 'create']);
Route::get('/clients/{client_id}', [ClientController::class, 'show']);
Route::post('/clients/{client_id}', [ClientController::class, 'modify']);

Route::get('/reservations/{client_id}', [RoomsController::class, 'checkAvailableRooms']);
Route::post('/reservations/{client_id}', [RoomsController::class, 'checkAvailableRooms']);

Route::get('/book/room/{client_id}/{room_id}/{date_in}/{date_out}', [ReservationController::class, 'bookRoom']);

Route::get('/ex', [ContentsController::class, 'home']);
