<template>

<section>
     <div>
         <p>{{product.name}} {{product.total}}€</p>
         <span>Quantità {{product.qty}}</span>

          <v-btn elevation="3" icon class="btn " @click.prevent="$emit('clickRemove', product)"> <i class="fas color-icon fa-minus"></i> </v-btn>
          <v-btn elevation="3" icon class="btn"  @click.prevent="$emit('clickAdd', product)"><i class="fas  color-icon fa-plus"></i></v-btn>
      </div>


 </section>


</template>

<script>
export default {
     name: 'Cart',
     props: ['product' , 'total' ],
      data(){
         return{
             cart: {},
         }
     },
}
</script>


<style scoped lang="scss">
/* .fakew-h{
    width:400px;
    height: 500px;
  padding: 10px;
}
.color-icon{
    color:#DE9233;
}
.btn{
    background:#F5DC45;
} */
</style>
