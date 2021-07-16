<template>
  <div>
      <div v-if="my_restaurant">
            <h1>{{my_restaurant.restaurant.name}}</h1>
            <h1>{{my_restaurant.restaurant.address}}</h1>
            <hr>
            <div v-for="category in my_categories" :key="category.id">
                <h2>{{category}}</h2>
                <div v-for="products in my_restaurant.products" :key="products.id">
                   <span v-if="category == products.category.name">{{products.name}}</span> 
                   <button v-if="category == products.category.name">add</button>
                </div>
            </div>
      </div>
  </div>
</template>

<script>
export default {
    name: "RestaurantShow",
    data(){
      return{
            my_restaurant : null,
            my_categories : [],
        }
    },
    created(){
       this.getRestaurant();
    },
    methods:{
        getRestaurant(){
            axios
            .get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.slug}`)
            .then(res=>{
                this.my_restaurant = res.data;

                res.data.products.forEach(element => {
                    if(!this.my_categories.includes(element.category.name)){
                        this.my_categories.push(element.category.name);
                    }
                });
            }).catch(err=>{
                console.log(err);
            })
        }
    },
}
</script>

<style>

</style>