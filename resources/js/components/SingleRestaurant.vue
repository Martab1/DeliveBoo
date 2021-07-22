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
            <h1 class="menù">Il nostro Menù</h1>
            <div v-for="category in my_categories" :key="category.id">
                <h3>{{ category }}</h3>
                <section class="section-card">
                    <div id="app">
                        <div>
                            <v-card
                                class="mx-auto product-card"
                                max-width="400"
                                max-height="300"
                                v-for="product in my_restaurant.products"
                                :key="product.id"
                            >
                                <div v-if="category == product.category.name">
                                    <v-img
                                        class="black--text align-end"
                                        height="100px"
                                        width="100%"
                                        v-if="product.image"
                                        :src="/storage/ + product.image"
                                        :alt="product.name"
                                    >
                                    </v-img>
                                    <v-img
                                        class="black--text align-end"
                                        height="100px"
                                        width="100%"
                                        v-else
                                        :src="
                                            /no_covers/ + 'no_cover_product.png'
                                        "
                                        alt="default"
                                    >
                                    </v-img>
                                    <v-card-title>{{
                                        product.name
                                    }}</v-card-title>

                                    <v-card-text class="text--primary">
                                        <div class="description">
                                            {{ product.description }}
                                        </div>
                                    </v-card-text>

                                    <div v-if="product.visibility">
                                        <div class="pb-0">
                                            <div class="price">
                                                {{ product.price }}€
                                            </div>
                                        </div>

                                        <v-card-actions>
                                            <span class="text-center input-qty"
                                                ><input
                                                    type="number"
                                                    min="1"
                                                    placeholder="0"
                                                    class="form-control"
                                                />{{ total }}</span
                                            >
                                            <div class="btn-container">
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
                                                    color="orange lighten-2"
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
                                        </v-card-actions>
                                    </div>
                                    <button class="notvisible" v-else disabled>
                                        Non disponibile
                                    </button>
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
h1,
h2,
span {
    color: brown;
}
h3 {
    padding-top: 15px;
    padding-left: 20px;
    text-transform: uppercase;
    font-size: 25px;
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
    width: 800px;
    margin: 30px;
    border-radius: 5px;
    background-color: #d989ad;
    box-shadow: 3px 2px 4px darkred;
}
.single-restaurant-title {
    padding-top: 20px;
    padding-left: 30px;
    font-size: 30px;
}
.single-restaurant-address {
    padding-left: 30px;
    padding-bottom: 20px;
    font-size: 20px;
}
.v-sheet.v-card {
    border-radius: 15px;
}
.section-card {
    display: flex;
    text-align: center;
    justify-content: space-around;
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
    text-align: start;
    margin-left: 20px;
}
.price {
    text-align: start;
    margin-left: 35px;
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
</style>
