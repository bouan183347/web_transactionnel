<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Produit;



Class ListProduits extends BaseController
{
    public function __invoke()
    {
        /*
        $entry1 = array(
            'nom' => 'roger',
            'url' => 'htp',
            'prix' => 3
        );
        $entry2 = array(
            'nom' => 'jean',
            'url' => 'ttps',
            'prix' => 2
        );
        
        $tblTest = array('entry1' => $entry1,'entry2' => $entry2);
        */
        $testBd = Produit::all();
        
        

       
        return view('list')->with(compact('testBd'));
        /*->with(compact('tblTest'))*/
    }
}