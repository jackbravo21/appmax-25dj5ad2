<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers;

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


Route::namespace("api")->name("api")->group(function(){

    Route::prefix("produtos")->group(function(){

        Route::get("/show", [ProductController::class, "show"])->name("show");
        
        Route::post("/cadastrar", [ProductController::class, "create"])->name("cadastrar");

        Route::put("/movimentacao", [ProductController::class, "stock"])->name("movimentacao");

        Route::get("/historico", [ProductController::class, "historico"])->name("historico");


        //vou deixar as opcoes de testes;
        Route::get("/teste", [ProductController::class, "teste"])->name("teste");
        Route::post("/testeecho", [ProductController::class, "testeEcho"])->name("testeecho");
        Route::post("/testejson", [ProductController::class, "testeJson"])->name("testejson");

    });

});






