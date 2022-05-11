<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AjoutProduits;
use App\Http\Controllers\ConsultationProduits;
use App\Http\Controllers\ModificationProduits;
use App\Http\Controllers\ListProduits;

use Illuminate\Http\RedirectResponse;

/*
Route::get("/",ListProduits::class);

Route::get("/produits",ListProduits::class);

Route::get("/produits/consultation/{id}",ConsultationProduits::class);

Route::get("/produits/consultation",function(){
    return redirect('/');
});

Route::get("/produits/ajouts",[AjoutProduits::class,'start']);

Route::get("/produits/modification/{id}",[ModificationProduits::class,'start']);

Route::get("/produits/modification",function(){
    return redirect('/');
});



Route::post("/produits/ajouts",[AjoutProduits::class,'validation']);

Route::post("/produits/modification/{id}",[ModificationProduits::class,'validation']);

*/