<template>
<section class="section-card">
                    <div id="app">
                        <div class="section-crd">
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

</template>

<script>
export default {

}
</script>

<style>

</style>
