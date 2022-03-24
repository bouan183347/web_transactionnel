<script>
import NavBar from '../components/NavBarTemplate.vue';
import ProduitTemplate from '../components/ProduitTemplate.vue';


export default{

    data(){
        return{
            tblProduits : [],
            idProduit : "",
            imgSrc: "",
            nomProduit : "",
            prixProduit : 0,
            fournisseur : "",
            quantiteProduit : 0
            
        };
    },

    created(){
        this.FetchSearchParams();
        
       
    },

    components : {
        NavBar,
        ProduitTemplate
    },

    methods: {
        ouvertureBD: function(){

            var requete = indexedDB.open("ProduitsDB",1);

            requete.onupgradeneeded = function(event){

                var bd = event.target.result;

                var options = {
                        keyPath: "id",
                    autoIncrement: true
                };

                var produits = bd.createObjectStore("Produits", options);

                produits.createIndex("mainIndex", "id");
            };

            var component = this;

            requete.onerror = function(event){
                reject(event.target.errorCode);
            };

            requete.onsuccess = function(event){
                component.bd = event.target.result;
                console.log(component.bd);
                component.fetchProduits();
            }

        },

        fetchProduits: function(){
            var component = this;
            var transaction = component.bd.transaction(["Produits"], "readonly");
            var tblProduits = transaction.objectStore("Produits");
            tblProduits.openCursor().onsuccess = function(event){
                var cursor = event.target.result;
                if(cursor){
                    console.log("cherche cursor")
                    if(cursor.value.id == component.idProduit)
                    {
                        component.imgSrc = cursor.value.imgSrc;
                        component.prixProduit = parseInt(cursor.value.prixProduit);
                        component.nomProduit = cursor.value.nomProduit;
                        component.fournisseur = cursor.value.fournisseur;
                        component.quantiteProduit = parseInt(cursor.value.quantiteProduit);
                        component.idProduit = parseInt(cursor.value.id);
                        console.log("trouver le bon id");
                    }
                    //component.tblProduits.push(cursor.value);
                    cursor.continue();
                }

                         console.log("affichage22222")
                        console.log(component.nomProduit);
                        console.log(component.imgSrc);
                        console.log(component.prixProduit);
                        console.log(component.fournisseur);
                        console.log(component.quantiteProduit);
             
            }

        

          
            

            

        },

        FetchSearchParams: function(){
            console.log("fetch les params")

            var component = this;
            var params = new URLSearchParams(window.location.search);
            if(params.has('id'))
            {
                component.idProduit = params.get('id')
                console.log(component.idProduit)
            }

            this.ouvertureBD();
        },

        modificationBD: function(){
            var component = this;
            var transaction = component.bd.transaction(["Produits"],"readwrite");
            var mesProduits = transaction.objectStore("Produits");

            var idRequest = mesProduits.get(component.idProduit);
            idRequest.onsuccess = function(){
                var data = idRequest.result;
                console.log(data);
                

                data.nomProduit = component.nomProduit;
                data.imgSrc = component.imgSrc;
                data.prixProduit = component.prixProduit.toString();
                data.fournisseur = component.fournisseur;
                data.quantiteProduit = component.quantiteProduit.toString();

                console.log(data);

                var updateBD = mesProduits.put(data);

                updateBD.onsuccess = function(){
                console.log("modification effectuer sur l'id " + component.idProduit)
            }
            }

            

           
            
        },

        

        Sauvegarder:function(){
            var component = this;
            if(component.nomProduit != "" && component.imgSrc != "" && component.fournisseur != "" && component.prixProduit != 0 && component.quantiteProduit != 0 ){
                this.modificationBD();
                var domain = window.location.hostname;
                console.log(domain);
                window.location.href = "http://" + domain + ":3000"; 
                

               
                
            }
            else{
                window.alert("certain champs sont vide, le produit ne sera pas modifier");
                var domain = window.location.hostname;
                console.log(domain);
                window.location.href = "http://" + domain + ":3000"; 
            }
            
        }        

    },

}


</script>

<template>
     <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <NavBar></NavBar>
        
        <ProduitTemplate choisirImage :nom-produit="nomProduit" :fournisseur="fournisseur" :prix-produit="prixProduit" @sauvegarde="Sauvegarder" v-model:imgSrc="imgSrc" v-model:nomProduit="nomProduit" v-model:fournisseur="fournisseur" v-model:prixProduit="prixProduit" v-model:quantiteProduit="quantiteProduit" ></ProduitTemplate>


    </div>
        <!-- ============================================================== -->
        <!-- end main wrapper  -->
        <!-- ============================================================== -->
        
</template>