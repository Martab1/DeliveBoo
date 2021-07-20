<template>
  <div>
      <div v-if="my_restaurant">
            <h1>{{my_restaurant.restaurant.name}}</h1>
            <h1>{{my_restaurant.restaurant.address}}</h1>
            <hr>
            <div v-for="category in my_categories" :key="category.id">
                <h2>{{category}}</h2>
                <div v-for="product in my_restaurant.products" :key="product.id">
                   <span v-if="category == product.category.name">{{product.name}}</span> 
                   <button  @click="remove(product)" v-if="category == product.category.name">-</button>
                   <button  @click="add(product)" v-if="category == product.category.name">+</button>
                </div>
            </div>
            <hr>
            <h2>Carrello</h2>
            <div v-for="product in cart.products" :key="product.id">
                <span>prodotto: {{product.name}} prezzo {{product.total}} Quantità: {{product.qty}}</span>
                <button  @click="remove(product)">-</button>
                <button  @click="add(product)">+</button>
            </div>
            <hr>
            <div>Total: {{total}}</div>
            <router-link :to="{name:'payment', params:{restaurantId: cart.key, orderTotal: total}}"> Completa l'acquisto </router-link>
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
            cart : {
                key: "",
                products: [],
            },
            total : 0,
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
                this.cart.key = res.data.restaurant.id;
                res.data.products.forEach(element => {
                    if(!this.my_categories.includes(element.category.name)){
                        this.my_categories.push(element.category.name);
                    }
                });
                this.init();
            }).catch(err=>{
                console.log(err);
            })
        },

        //AGGIUNTA PRODOTTI NELL'ARRAY CHE POPOLERA IL CART DAL LOCALSTORAGE
        add(product){
            if(this.find(product.id)){
                this.increment(product.id)
            }else{
                let obj = {
                    'name': product.name,
                    'id': product.id,
                    'price': product.price,
                    'qty': 1,
                    'total' : product.price,
                };
                this.cart.products.push(obj);
            }
                this.total += product.price; 
        this.sync();
        },

        //RIMUOVI PRODOTTI
        remove(product){
            if(this.find(product.id)){
                this.decrement(product.id)
            }
        this.sync();
            this.total -= product.price; 

        },

        //SINCRONIZZAZIONE DATI LOCAL STORAGE
        async sync(){
            let content = JSON.stringify(this.cart.products)
            await localStorage.setItem(this.cart.key, content);
        },

        //CONTROLLO SE UN PRODOTTO è GIA PRESENTE NEL CARRELLO
        find(id){
            let check = undefined;
            this.cart.products.forEach(e=>{
                if(e.id == id){
                    check = true;
                }
            })
            return check;
        },

        //INCREMENTO QTY
        increment(id){
            this.cart.products = this.cart.products.map(e=>{
                if(e.id == id){
                    e.qty += 1;
                    e.total = e.price * e.qty;
                    return e;
                }else{
                    return e;
                }

            })
        },

        //DECREMENTO QTY
        decrement(id){
            this.cart.products.forEach(e=>{
                if(e.id == id){
                    e.qty -= 1;
                    e.total = e.price * e.qty;
                    if(e.qty == 0){
                        this.cart.products.forEach((e, index)=>{
                            if(e.id == id){
                                this.cart.products.splice(index, 1);
                            }
                        })
                    }
                } 
            })
        },

        init(){
            for (var i = 0; i < localStorage.length; i++){
               if(this.cart.key != localStorage.key(i)){
                     localStorage.removeItem(i); 
                }
            }
            let contents = localStorage.getItem(this.cart.key);
            if(contents){
                this.cart.products = JSON.parse(contents);
            }
            this.cart.products.forEach(e=>{
                this.total += e.total;
            })
        },
    },
}
</script>

<style>

</style>