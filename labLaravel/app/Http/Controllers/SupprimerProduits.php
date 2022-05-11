<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Models\Produit;

Class SupprimerProduits extends BaseController
{
    public function __invoke($id)
    {
        if($id >= 0)
        {
            $produit = Produit::findOrFail($id);
            
            $produit->delete();

            return response()->json([
                'message' => 'supression effectuer',
                'idChanger' => $id
            ]);
            
        }
    }
}