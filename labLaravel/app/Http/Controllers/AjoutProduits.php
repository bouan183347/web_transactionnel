<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

Class AjoutProduits extends BaseController
{
    public function start()
    {
        return view('ajout');
        //return "testajout";
    }

    public function validation(Request $request)
    {
        
           
            $produit = new Produit;

            $produit = $request->all();

            $produit = Produit::Create($produit);

            return response()->json([
                'message' => 'ajout reussi'
            ]);
            

        
        

        
        
    }
}