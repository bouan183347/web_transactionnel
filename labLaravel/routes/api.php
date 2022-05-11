<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AjoutProduits;
use App\Http\Controllers\ConsultationProduits;
use App\Http\Controllers\ModificationProduits;
use App\Http\Controllers\ListProduits;
use App\Http\Controllers\SupprimerProduits;

use Illuminate\Http\RedirectResponse;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
|    return $request->user();
|    });
*/


Route::get("/produits",ListProduits::class)->middleware('auth.basic');

Route::get("produits/{id}",ConsultationProduits::class)->middleware('auth.basic');


Route::post("/produits/ajouts",[AjoutProduits::class,'validation'])->middleware('auth.basic');


Route::put("/produits/{id}",[ModificationProduits::class,'validation'])->middleware('auth.basic');

Route::put("/produits/{id}/{newQuantite}",[ModificationProduits::class,'nouvelleQuantite'])->middleware('auth.basic');


Route::delete("/produits/{id}",SupprimerProduits::class)->middleware('auth.basic');