<script>
import NavBar from '../components/NavBarTemplate.vue';
import ProduitListTemplate from '../components/ProduitListTemplate.vue';


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
        
    },

    components : {
        NavBar,
        ProduitListTemplate
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
                //console.log(component.bd);
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
            
            //console.log(tblProduits)
        },
   
        goModif:function(id,direction){
            var domain = "http://"+window.location.hostname + ":3000";
            console.log(domain);
            domain += "/" + direction;

            var url = new URL(domain);
            console.log(domain);

            var search_params = url.searchParams;
            search_params.set("id",id);
            url.search = search_params.toString();
            var new_url = url.toString();
            console.log(new_url);

            window.location.href = new_url;
            
        }



    },

}


</script>

<template>
  <main>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
      <NavBar></NavBar>
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    
                    <div class="row">
                        <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12 col-12">
                            <button @click="goModif(0,'ajout')">ajouter un produit</button>
                            <div class="row">
                            

                            <div v-for="produit in tblProduits">
                            <ProduitListTemplate @detail="(n) => goModif(n,'produit')" @modifier="(n) => goModif(n,'modification')" :nom-produit="produit.nomProduit" :prix-produit="produit.prixProduit" :img-src="produit.imgSrc" :id-produit="produit.id"></ProduitListTemplate>
                            </div>
                                
            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end wrapper  -->
            <!-- ============================================================== -->
        </div>
    </div>
        <!-- ============================================================== -->
        <!-- end main wrapper  -->
        
  </main>
</template>
