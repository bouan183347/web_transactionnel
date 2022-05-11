<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Produit;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    
    use DatabaseTransactions;

    public function testCredential()
    {
        $this->json('GET','api/produits')->assertStatus(401);
    }

    public function testJsonAjout()
    {
        $this->withoutMiddleware();

        $produitTest = [
            "nom" => "test",
            "fournisseur" => "testfour",
            "url" => "testurl",
            "quantite" => 4,
            "prix" => 2
        ];


        $this->json('POST','api/produits/ajouts',$produitTest,['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            "message" => "ajout reussi"
        ]);

        $this->assertDatabaseHas('produits',['nom' => 'test']);
    }

    public function testDelete()
    {
        $this->withoutMiddleware();
       
        $produit2 = ["id" => 200,"nom" => "test2","fournisseur" => "testfour","url" => "testurl","quantite" => 2,"prix" => 3];
    

        $test = Produit::create($produit2);



        $this->assertDatabaseHas('produits',['nom' => 'test2']);

        $requete = Produit::orderBy('id','desc')->first();

        $this->json('DELETE','api/produits/'.$requete->id)->assertStatus(200)->assertJson([
            'message' => 'supression effectuer',
            'idChanger' => $requete->id
        ]);


        
        
    }
}
