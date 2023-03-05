<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
 * CADASTRO
 * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
 */
Route::post('cadastro/store', [CadastroController::class, 'store']);

/**
 * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
 * login
 * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
 */
Route::post('login', [AuthController::class, 'login']);

/**
 * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
 * logout
 * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
 */
Route::post('logout', [AuthController::class, 'logout']);


Route::get('index',[CadastroController::class, 'index']);
Route::get('show/{id}',[CadastroController::class, 'show']);
Route::post('update/{id}',[CadastroController::class, 'update']);
Route::delete('destroy/{id}',[CadastroController::class, 'destroy']);







// adm
Route::middleware('acesso.adm','jwt.auth','log.acesso')->prefix('adm/')->group(function(){
    Route::post('adm', [AuthController::class, 'adm']);
});

// usuario
Route::middleware('acesso.usuario','jwt.auth','log.acesso')->prefix('usuario/')->group(function(){
    Route::post('usuario', [AuthController::class, 'usuario']);
});
