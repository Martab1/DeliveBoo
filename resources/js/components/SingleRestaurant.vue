<!-- Name Restaurant -->
<template>
    <section d-flex>
        <div
            class="sg-restaurant-section-container category-container"
            v-if="my_restaurant"
        >
            <h1 class="single-restaurant-title">
                {{ my_restaurant.restaurant.name }}
            </h1>
            <h2 class="single-restaurant-address">
                {{ my_restaurant.restaurant.address }}
            </h2>
        </div>

        <!-- Products Restaurant -->
        <div class="sg-restaurant-section-container">
            <div class="container-menu">
                <h1 class="menu">Menù</h1>
            </div>
            <div v-for="category in my_categories" :key="category.id">
                <h3 class="category-container">{{ category }}</h3>
                <section class="section-card">
                    <div id="app">
                        <div class="section-crd">
                            <v-card
                                class="mx-auto product-card"
                                max-width="250"
                                max-height="150"
                                v-for="product in my_restaurant.products"
                                :key="product.id"
                            >
                                <div
                                    class="row"
                                    v-if="category == product.category.name"
                                >
                                    <div class="col-4">
                                        <v-img
                                            height="50%"
                                            width="100%"
                                            style="border-radius:50%;"
                                            v-if="product.image"
                                            :src="/storage/ + product.image"
                                            :alt="product.name"
                                        >
                                        </v-img>
                                        <v-img
                                            height="50%"
                                            width="100%"
                                            style="border-radius:50%;"
                                            v-else
                                            :src="
                                                /no_covers/ +
                                                    'no_cover_product.png'
                                            "
                                            alt="default"
                                        >
                                        </v-img>
                                    </div>

                                    <div class="col-8">
                                        <v-card-title>{{
                                            product.name
                                        }}</v-card-title>

                                        <v-card-text class="text--primary">
                                            <div class="description">
                                                {{ product.description }}
                                            </div>
                                        </v-card-text>

                                        <v-card-actions>
                                            <div class="btn-container" v-if="product.visibility">
                                                <div>
                                                    <div class="pb-0">
                                                        <div class="price">
                                                            {{ product.price }}€
                                                        </div>
                                                    </div>
                                                </div>

                                                <v-btn
                                                    color="orange lighten-2"
                                                    @click.prevent="
                                                        $emit(
                                                            'clickRemove',
                                                            product
                                                        )
                                                    "
                                                    v-if="
                                                        category ==
                                                            product.category
                                                                .name
                                                    "
                                                >
                                                    -
                                                </v-btn>
                                                <v-btn
                                                    color="red lighten-2"
                                                    @click.prevent="
                                                        $emit(
                                                            'clickAdd',
                                                            product
                                                        )
                                                    "
                                                    v-if="
                                                        category ==
                                                            product.category
                                                                .name
                                                    "
                                                >
                                                    +
                                                </v-btn>
                                            </div>
                                             <button v-else>
                                                    Non disponibile
                                                </button>
                                        </v-card-actions>
                                    </div>
                                </div>
                            </v-card>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "SingleRestaurant",
    props: ["product", "my_restaurant", "my_categories"],
    data() {
        return {
            restaurant: {}
        };
    }
};
</script>

<style scoped lang="scss">
@import "../../sass/vars.scss";
h1,
h2,
span {
    color: antiquewhite;
}
h3 {
    padding-left: 20px;
    text-transform: capitalize;
    font-size: 25px;
    color: antiquewhite;
}
h4 {
    padding-left: 20px;
    padding-bottom: 10px;
}
span {
    padding-left: 20px;
    padding-bottom: 10px;
}
img {
    max-width: 100%;
}
.sg-restaurant-section-container {
    width: 1000px;
    margin-right: 25px;
    margin-bottom: 15px;
    border-radius: 5px;
    background-color: #d989ad;
    box-shadow: 3px 2px 4px antiquewhite;
}
.single-restaurant-title {
    padding-top: 20px;
    padding-left: 30px;
    font-size: 30px;
    color: antiquewhite;
}
.single-restaurant-address {
    padding-left: 30px;
    padding-bottom: 20px;
    font-size: 20px;
}
.v-sheet.v-card {
    border-radius: 5px;
    background: #f7c7dc;
    margin: 30px;
}
.section-card {
    text-align: center;
    justify-content: space-between;
    padding-bottom: 10px;
    padding-top: 10px;
}
.v-card__title {
    display: block;
    font-size: 1.25rem;
    font-weight: 500;
    letter-spacing: 0.0125em;
    word-break: break-all;
}
span[data-v-1859ace0] {
    padding-left: 0;
    padding-bottom: 0;
}
.v-card__subtitle,
.v-card__text,
.v-card__title {
    text-align: center;
}
hr {
    margin-top: 10px;
}
.v-card__title {
    padding: 0;
    text-transform: capitalize;
}
.restricted {
    height: 80px;
    overflow-y: scroll;
}
input {
    width: 35px;
}
.v-application--wrap {
    min-height: 200px;
    max-width: 200px;
}
.product-card {
    margin-bottom: 40px;
}
.numberbox {
    display: flex;
    align-self: flex-end;
}
.menù {
    text-align: center;
    font-size: 35px;
}
.btn-container {
    display: flex;
    justify-items: flex-end;
}
.v-card__actions {
    align-items: center;
    display: flex;
    padding: 8px;
    justify-content: flex-end;
}
.description {
    overflow: auto;
    height: 50px;
}
.price {
    text-align: start;
    margin-right: 50px;
    padding-top: 10px;
    color: crimson;
}
.notvisible {
    padding-bottom: 20px;
}
.v-btn:not(.v-btn--round).v-size--default {
    height: 36px;
    min-width: 64px;
    padding: 10px 16px;
    margin: 5px;
}
.input-qty {
    margin-right: 20px;
}
.section-crd {
    display: flex;
    justify-content: space-between;
}

/* l */
.container-menu {
    background: $layout-color;
    color: $content-color;
    padding: 15px;
}
.menu {
    color: white;
    text-align: center;
}
h2,
h3,
p {
    margin: 0;
}
.section {
    padding: 70px 0;
}
.container {
    max-width: 375px;
    margin: 0 auto;
}
.grid {
    display: grid;
    grid-template: 1fr / repeat(2, 1fr);
    grid-gap: 25px;
}
.card {
    position: relative;
    max-width: 80%;
    margin: 0 auto;
}
.card__image {
    position: absolute;
    max-width: 130%;
    left: -15%;
    right: 0;
    margin: 0 auto;
    top: -18%;
    z-index: 2;
    border-radius: 50%;
    transition: all 0.3s ease-out;
    -webkit-filter: drop-shadow(5px 5px 5px #222);
    filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.3));
}
.card__data {
    border-top-right-radius: 50%;
    border-top-left-radius: 50%;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    background-color: #ededed;
    padding-top: calc(100% * 1.18);
    transition: all 0.3s ease-out 0.1s;
}
.card__info {
    padding: 0 10px;
    margin-bottom: 10px;
}
.card__info h2 {
    font-size: 14px;
    font-weight: 800;
}
.card__info p {
    font-size: 10px;
    line-height: 14px;
    color: #a2a2a2;
}
.card__action {
    display: grid;
    grid-template: 30px / 1fr 35px;
}
.card__price {
    height: 30px;
    padding: 0 10px 0 20px;
    font-size: 14px;
    display: flex;
    align-items: center;
    font-weight: 800;
}
.card__add {
    overflow: hidden;
    width: 35px;
    height: 30px;
    right: 0;
    bottom: 0;
    position: absolute;
    background-color: #222222;
    border: none;
    color: #fff;
    border-top-left-radius: 15px;
    border-bottom-right-radius: 15px;
    font-size: 20px;
    cursor: pointer;
    outline: none;
    transition: all 0.3s ease-in;
}
.card__add:hover {
    opacity: 0.8;
    transform: scale(1.1);
}
.card__add:active {
    opacity: 1;
    transform: scale(0.8);
}
.card:hover .card__image {
    top: -20%;
}
.card:hover .card__data {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}
.category-container {
    background: crimson;
}
.v-image__image--cover {
    background-size: cover;
    border-radius: 50%;
}
</style>
