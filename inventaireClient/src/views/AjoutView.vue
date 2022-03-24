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
        this.ouvertureBD();
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
                    component.tblProduits.push(cursor.value);
                    cursor.continue();
                }
            }
            console.log(tblProduits)
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
        },

        modificationBD: function(){
            var component = this;
            var transaction = component.bd.transaction(["Produits"],"readwrite");
            var mesProduits = transaction.objectStore("Produits");

            var idRequest = mesProduits.get(component.idProduit);
            idRequest.onsuccess = function(){

                var data = idRequest.result;
                // modifier data avec les nouveaux attribut
                var updateBD = mesProduits.put(data);

                updateBD.onsuccess = function(){
                    console.log("modification effectuer sur l'id " + data.id)
                }
            }
        },

        AjoutBD: function(){
            var component = this;

            var transaction = component.bd.transaction(["Produits"],"readwrite");
            var mesProduits = transaction.objectStore("Produits");
           /*
            console.log(component.nomProduit);
            console.log(component.imgSrc);
            console.log(component.prixProduit);
            console.log(component.fournisseur);
            console.log(component.quantiteProduit);
        */
        
            mesProduits.add({
               
                nomProduit : component.nomProduit,
                imgSrc : component.imgSrc,
                prixProduit : component.prixProduit,
                fournisseur : component.fournisseur,
                quantiteProduit : component.quantiteProduit,
                

                
            })
            
        },

        Sauvegarder:function(){
            var component = this;
            if(component.nomProduit != "" && component.imgSrc != "" && component.fournisseur != "" && component.prixProduit != 0 && component.quantiteProduit != 0 ){
                this.AjoutBD();
                var domain = window.location.hostname;
                console.log(domain);
                window.location.href = "http://" + domain + ":3000"; 
                

               
                
            }
            else{
                window.alert("tout les champs n'ont pas ete remplie, le produit ne sera pas ajouter");
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
        <ProduitTemplate choisirImage @sauvegarde="Sauvegarder" v-model:imgSrc="imgSrc" v-model:nomProduit="nomProduit" v-model:fournisseur="fournisseur" v-model:prixProduit="prixProduit" v-model:quantiteProduit="quantiteProduit" ></ProduitTemplate>
      

    </div>
        <!-- ============================================================== -->
        <!-- end main wrapper  -->
        <!-- ============================================================== -->
        
        
</template>

