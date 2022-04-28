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
        if($request->has('nomAjout') && $request->has('urlAjout') && $request->has('quantiteAjout') && $request->has('fournisseurAjout') && $request->has('prixAjout')){
           
            $produit = new Produit;

            $produit->nom = $request->input('nomAjout');

            $produit->url = $request->input('urlAjout');

            $produit->quantite = $request->input('quantiteAjout');

            $produit->fournisseur = $request->input('fournisseurAjout');

            $produit->prix = $request->input('prixAjout');

            $produit->save();

            return redirect('/');

        }

        else 
        {
            return redirect('/produits/ajouts');
           // return "testajoutvali";
        }
        
        
    }
}