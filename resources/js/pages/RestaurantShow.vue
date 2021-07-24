<template>
    <div class="" >
        <div class="container flex">
            <SingleRestaurant
                :product="product"
                :cart="cart.products"
                :my_categories="my_categories"
                :my_restaurant="my_restaurant"
                @clickAdd="add"
                @clickRemove="remove"
            />

            <!-- Carrello -->
            <div class="cart-w">
                <div class="fakew-h cart  container-cart">
                    <h2 class="text-uppercase text-center mb-6">
                        il tuo carrello
                    </h2>
                    <div class="sub-container-my-order">
                        <Cart
                            v-for="product in cart.products"
                            :key="product.id"
                            :product="product"
                            class="mb-3 text-capitalize"
                            :total="total"
                            @clickAdd="add"
                            @clickRemove="remove"
                            @clickRemoveCart="removeCart"
                        />
                    </div>
                    <v-divider class="mt-5 mb-5"></v-divider>
                    <div class="text-center">
                        <v-chip filter class="text-center font-w ">
                            Totale {{ total }}€
                        </v-chip>
                    </div>
                    <div v-if="total === 0" class="text-center mt-12">
                        Non hai ancora aggiunto alcun prodotto. Quando lo farai,
                        compariranno qui!
                    </div>
                    <div v-else class="d-flex justify-space-between  mt-8">
                        <v-btn
                            elevation="3"
                            class="mt-5 mr-3 btn d-inline  "
                            id="color"
                            @click="removeCart(cart)"
                            >Elimina</v-btn
                        >
                        <v-btn elevation="3" class="mt-5 d-inline"  id="color">
                            <router-link
                                class="no-decoration"
                                :to="{
                                    name: 'payment',
                                    params: {
                                        restaurantId: cart.key,
                                        orderTotal: total
                                    }
                                }"
                            >
                                Ordina
                            </router-link>
                        </v-btn>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Cart from "../components/Cart.vue";
import SingleRestaurant from "../components/SingleRestaurant.vue";
export default {
    name: "RestaurantShow",
    components: {
        Cart,
        SingleRestaurant
    },
    data() {
        return {
            my_restaurant: null,
            my_categories: [],
            cart: {
                key: "",
                products: []
            },
            total: 0
        };
    },
    created() {
        this.getRestaurant();
    },
    methods: {
        getRestaurant() {
            axios
                .get(
                    `http://127.0.0.1:8000/api/restaurants/${this.$route.params.slug}`
                )
                .then(res => {
                    this.my_restaurant = res.data;
                    this.cart.key = res.data.restaurant.id;
                    res.data.products.forEach(element => {
                        if (
                            !this.my_categories.includes(element.category.name)
                        ) {
                            this.my_categories.push(element.category.name);
                        }
                    });
                    this.init();
                })
                .catch(err => {
                    console.log(err);
                });
        },

        //AGGIUNTA PRODOTTI NELL'ARRAY CHE POPOLERA IL CART DAL LOCALSTORAGE
        add(product) {
            if (this.find(product.id)) {
                this.increment(product.id);
            } else {
                let obj = {
                    name: product.name,
                    id: product.id,
                    price: product.price,
                    qty: 1,
                    total: product.price
                };
                this.cart.products.push(obj);
            }
            this.total += product.price;
            this.sync();
        },

        //RIMUOVI PRODOTTI
        remove(product) {
            if (this.find(product.id)) {
                this.decrement(product.id);
            }
            this.sync();
            if (this.total != 0) {
                this.total -= product.price;
            } else {
                this.total = 0;
            }
        },

        //SINCRONIZZAZIONE DATI LOCAL STORAGE
        async sync() {
            let content = JSON.stringify(this.cart.products);
            await localStorage.setItem(this.cart.key, content);
        },

        //CONTROLLO SE UN PRODOTTO è GIA PRESENTE NEL CARRELLO
        find(id) {
            let check = undefined;
            this.cart.products.forEach(e => {
                if (e.id == id) {
                    check = true;
                }
            });
            return check;
        },

        //INCREMENTO QTY
        increment(id) {
            this.cart.products = this.cart.products.map(e => {
                if (e.id == id) {
                    e.qty += 1;
                    e.total = e.price * e.qty;
                    return e;
                } else {
                    return e;
                }
            });
        },

        //DECREMENTO QTY
        decrement(id) {
            this.cart.products.forEach(e => {
                if (e.id == id) {
                    e.qty -= 1;
                    e.total = e.price * e.qty;
                    if (e.qty == 0) {
                        this.cart.products.forEach((e, index) => {
                            if (e.id == id) {
                                this.cart.products.splice(index, 1);
                            }
                        });
                    }
                }
            });
        },
        // RIMUOVI TUTTO IL CARRELLO
        removeCart(cart) {
            if (cart != 0) {
                this.total = 0;
                this.cart.products = [];
            }
            this.sync();
        },
        init() {
            for (var i = 0; i < localStorage.length; i++) {
                if (this.cart.key != localStorage.key(i)) {
                    localStorage.removeItem(i);
                }
            }
            let contents = localStorage.getItem(this.cart.key);
            if (contents) {
                this.cart.products = JSON.parse(contents);
            }
            this.cart.products.forEach(e => {
                this.total += e.total;
            });
        }
    }
};
</script>

<style scoped lang="scss">
@import '../../sass/vars.scss';
@import '../../sass/general.scss';
@import '../../sass/mixins.scss';

/* Carrello*/
.container{
    padding: 30px;
}
.flex{
    @include flex("flex");
}

.cart-w{
    flex-basis: 25%;
}

.container-cart{
    padding: 30px;
    color: #fff;
}
.fakew-h {
    border-radius: 15px;
}
.cart {
    background: $special-white;
    overflow: auto;
    color: $special-black2;
}
.no-decoration {
    text-decoration: none;
    color: black;
}

#color{
    background:$special-white;
    color: $special-black2;
}

#color:hover{
    background:$btn-hover;
}

.font-w{
   font-weight: 300;
}
</style>
