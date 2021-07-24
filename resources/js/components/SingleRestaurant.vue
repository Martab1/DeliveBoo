<!-- Name Restaurant -->
<template>
    <section class="single-restaurant">
        <div class="container-single-restaurant">
            <div class="bg-title">
                <img v-if="my_restaurant.restaurant.image" :src="/storage/ + my_restaurant.restaurant.image">
                <div class="layover">
                    <h1 class="single-restaurant-title">
                        {{ my_restaurant.restaurant.name }}
                    </h1>
                </div>
            </div>
                <template>
                <v-expansion-panels >
                    <v-expansion-panel
                    v-for="(category) in my_categories" :key="category.id">
                    <v-expansion-panel-header class="capitalize">{{ category }}</v-expansion-panel-header>
                    <div v-for="product in my_restaurant.products" :key="product.id">
                        <v-expansion-panel-content v-if="category == product.category.name">
                           <div>
                                <template>
                                    <div id="flex">
                                        <v-card
                                            flat
                                            id="card"
                                            outlined
                                        >
                                            <v-list-item three-line>
                                            <v-list-item-content>
                                                <div class="text-overline mb-4">
                                                    {{product.name}}
                                                </div>
                                                <v-list-item-title class="text-h5 mb-1">
                                                </v-list-item-title>
                                                <v-list-item-subtitle>{{product.description}}</v-list-item-subtitle>
                                            </v-list-item-content>
                                            <v-list-item-avatar
                                                tile
                                                size="80"
                                            >
                                            <img v-if="product.image" :src="/storage/ + product.image" :alt="product.name">
                                            <img v-else :src="/no_covers/ +'no_cover_product.png'" alt="default">
                                            </v-list-item-avatar>
                                            </v-list-item>
                                            <v-card-actions class="pr-16">
                                                <v-btn
                                                    elevation="3"
                                                    icon
                                                    color="lighten-2"
                                                    @click.prevent="$emit('clickRemove',product)"
                                                    v-if="category ==product.category.name">
                                                    <i class="fas  color-icon fa-minus"></i>
                                                </v-btn>
                                                <v-btn
                                                    elevation="3"
                                                    icon
                                                    color="lighten-2" @click.prevent="$emit('clickAdd',product)"
                                                    v-if="category ==product.category.name">
                                                    <i class="fas  color-icon fa-plus"></i>
                                                </v-btn>
                                                <div>
                                                    <span class="mx-20">{{ product.price }} € </span>
                                                    <span v-for="item in cart" :key="item.id">
                                                        <span v-if="item.name == product.name" class="mx-20">Qtà : {{item.qty}}</span>
                                                        <span v-if="item.name == product.name" class="mx-20">Totale : {{item.total}} €</span>
                                                    </span>
                                                </div>
                                            </v-card-actions>
                                        </v-card>
                                    </div>
                                </template>
                            </div>
                        </v-expansion-panel-content>
                    </div>
                    </v-expansion-panel>
                </v-expansion-panels>
                </template>
        </div>
    </section>
</template>

<script>
export default {
    name: "SingleRestaurant",
    props: ["product", "my_restaurant", "my_categories", "cart"],
    data() {
        return {
            restaurant: {},
            selected : null,
        };
    },
    methods:{
        selected(index){
            this.selected = index;
        }
    }
};
</script>

<style scoped lang="scss">
@import "../../sass/vars.scss";
@import "../../sass/mixins.scss";

.single-restaurant{
    flex-basis: calc(75% - 20px);
    margin-right: 20px;
}

.capitalize{
    text-transform: capitalize;
}

.pr-16{
    padding-left: 16px;
}

.bg-title{
    height: 100px;
    position: relative;
    border-top-left-radius: 10px; 
    border-top-right-radius: 10px; 
    overflow: hidden;
    h1{
        color: $special-white;
    }
    .layover{
        position: absolute;
        @include flex("center");
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        background-color:rgba(85, 83, 83, 0.2);
    }
    img{
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
}

#card{
    margin: 5px 0px;
}

#card img{
    width: 100%;
    height: 100%;
    object-fit: contain;
}

h1{
    text-transform: uppercase;
    text-align: center;
}

.mx-20{
    margin: 0px 20px;
}
</style>
