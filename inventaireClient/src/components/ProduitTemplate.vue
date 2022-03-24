<script>
    export default{
        props:{
            
            choisirImage : Boolean,
            imgSrc : String,
            nomProduit : String,
            fournisseur:String,
            prixProduit : Number,
            quantiteProduit : Number,
            btnModif : Boolean
        },

        emits:['update:imgSrc','update:nomProduit','update:fournisseur','update:prixProduit','update:quantiteProduit','sauvegarde','goModif'],

        data(){
            return{
                imgSrc:""
            }
        },
        methods:{
            changerImage:function(){
                var component = this;
                component.imgSrc = "../assets/images/etienne.png";
                console.log(component.imgSrc);
                this.$emit('update:imgSrc',component.imgSrc)
            }
        }


    }
</script>

<template>
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                
                <div class="row">
                    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pr-xl-0 pr-lg-0 pr-md-0  m-b-30">
                                <div class="product-slider">


                                    <img class="d-block" :src="imgSrc" alt="First slide">
                                    <a href="#" v-if="choisirImage" @click="changerImage" class="btn btn-primary btn-block btn-lg">Choisir une image</a>
                                
                                
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pl-xl-0 pl-lg-0 pl-md-0 border-left m-b-30">
                                <div class="product-details">
                                    <div class="border-bottom pb-3 mb-3">
                                       
                                       
                                        <h2 class="mb-3"><input type="text"  @input="$emit('update:nomProduit',$event.target.value)" :value="nomProduit"/></h2>
                                        <h3 class="mb-0 text-primary">$<input type="text" @input="$emit('update:prixProduit',$event.target.value)" :value="prixProduit"/></h3>
                                    
                                    
                                    </div>
                                    <div class="product-size border-bottom">
                                        <h4>Fournisseur</h4>
                                        
                                        
                                        <input type="text" @input="$emit('update:fournisseur',$event.target.value)" :value="fournisseur">
                                       
                                       
                                        <div class="product-qty">
                                            <h4>Quantité</h4>
                                            <div class="quantity">
                                               
                                               
                                                <input type="number" @input="$emit('update:quantiteProduit',$event.target.value)" :value="quantiteProduit">
                                            
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <h4 class="mb-1">Description</h4>
                                        <textarea rows="4" cols="50">Praesent et cursus quam. Etiam vulputate est et metus pellentesque iaculis. Suspendisse nec urna augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</textarea>
                                        <a href="#" class="btn btn-primary btn-block btn-lg" @click="$emit('sauvegarde')">Sauvegarder</a>
                                        <a href="#" v-if="btnModif" class="btn btn-primary btn-block btn-lg" @click="$emit('goModif')">modifier</a>
                                    </div>
                                </div>
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
</template>