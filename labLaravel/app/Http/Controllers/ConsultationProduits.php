<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Produit;

Class ConsultationProduits extends BaseController
{
    public function __invoke($id)
    {

        return Produit::findOrFail($id);

        /* ********************** lab 3 *******************
        $produit = Produit::findOrFail($id);

        */
        /*
        $produit = array(
            'nom' => 'pomme',
            'url' => 'htp',
            'fournisseur' => 'maxi',
            'prix' => 6,
            'quantite' => 10
        );*/

        /* ********************** lab 3 *******************
        return view('consultation')->with(compact('produit'));
       */
       
       
        // return $produit;

       // return Produit::findOrFail($id);
        /*->with(compact('produit'))*/
        
    }
}