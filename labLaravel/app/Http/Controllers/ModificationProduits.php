<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Models\Produit;

Class ModificationProduits extends BaseController
{
    public function start($id)
    {
        $produit = Produit::findOrFail($id);
        /*
        $produit = array(
            'nom' => 'pomme',
            'url' => 'htp',
            'fournisseur' => 'maxi',
            'prix' => 6,
            'quantite' => 10
        );
        */

        return view('modification')->with(compact('produit'));
    }

    public function validation(Request $request,$id)
    {
        if($request->has('nomAjout') && $request->has('urlAjout') && $request->has('quantiteAjout') && $request->has('fournisseurAjout') && $request->has('prixAjout')){
            
            $produit = Produit::findOrFail($id);

            $produit->nom = $request->input('nomAjout');

            $produit->url = $request->input('urlAjout');

            $produit->quantite = $request->input('quantiteAjout');

            $produit->fournisseur = $request->input('fournisseurAjout');

            $produit->prix = $request->input('prixAjout');

            $produit->save();

            return redirect('/');
        }

        else{
            return redirect('/produits/modification/'.$id);
        }
        
        
        
    }
}