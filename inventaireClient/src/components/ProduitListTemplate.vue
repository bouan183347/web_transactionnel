<script>
    export default{
        props:{
            imgSrc: String,
            nomProduit : String,
            prixProduit : String,
            idProduit : Number
         
        },
        emits:['detail','modifier']
    }
</script>

<template>
    <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="product-thumbnail">
            <div class="product-img-head">
                <div class="product-img">
                    <img :src="imgSrc" alt="" class="img-fluid">
                </div>
            </div>
            <div class="product-content">
                <div class="product-content-head">
                    <h3 class="product-title" >{{nomProduit}}</h3>
                    <div class="product-price" >{{prixProduit}}$</div>
                </div>
                <div class="product-btn">
                    <a href="#" class="btn btn-primary" @click="$emit('modifier',idProduit)">Modifier</a>
                    <a href="#" class="btn btn-outline-light" @click="$emit('detail',idProduit)">Détails</a>
                </div>
            </div>
        </div>
    </div>
</template>