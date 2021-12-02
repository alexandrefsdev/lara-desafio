<?php


use App\Http\Controllers\Api\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/cliente/{id}', [ClientController::class, 'getClient']);
Route::get('/consulta/final-placa/{numero}', [ClientController::class, 'getAllClientsWhoHaveTheSameLicensePlateEnds']);

Route::post('/cliente/', [ClientController::class, 'createClient']);
Route::put('/cliente/{id}', [ClientController::class, 'editClient']);
Route::delete('/cliente/{id}', [ClientController::class, 'deleteClient']);

