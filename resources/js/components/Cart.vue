<template>
    <section>
        <div class="vertical-center"> 
            <!-- <span class="mar-8">{{ product.name }} {{ product.total }}€</span>
            <span class="mar-8"> x {{ product.qty }}</span>
            <v-btn
                small
                elevation="3"
                icon
                class="btn mar-8"
                id="color"
                @click.prevent="$emit('clickRemove', product)"
            >
                <i class="fas color-icon fa-minus"></i>
            </v-btn>
            <v-btn 
                small
                elevation="3"
                icon
                class="btn"
                id="color"
                @click.prevent="$emit('clickAdd', product)"
                ><i class="fas color-icon fa-plus"></i
            ></v-btn> -->
            <div class="container-articles">
                <div class="article-name">{{ product.name }}</div>
                <div class="article-qty">qtà: {{ product.qty }}</div>
                <div class="article-total">€ {{ product.total }}</div>
                <div class="article-btn">
                    <v-btn
                        small
                        elevation="3"
                        icon
                        class="btn mar-8"
                        id="color"
                        @click.prevent="$emit('clickRemove', product)"
                    >
                        <i class="fas color-icon fa-minus"></i>
                    </v-btn>
                    <v-btn 
                        small
                        elevation="3"
                        icon
                        class="btn"
                        id="color"
                        @click.prevent="$emit('clickAdd', product)"
                        ><i class="fas color-icon fa-plus"></i
                    ></v-btn>
                </div>
            </div>
        </div>
        
    </section>
</template>

<script>
export default {
    name: "Cart",
    props: ["product", "total"],
    data() {
        return {
            cart: {}
        };
    }
};
</script>

<style scoped lang="scss">
@import '../../sass/vars.scss';
@import '../../sass/mixins.scss';

.vertical-center{
    @include flex("vertical");
}

.mar-8{
    margin-right: 5px;
}

.sub-container{
    padding: 10px;
    margin: 0 auto;
    // max-width: 70%;
}

.container-articles{
    @include flex("flex");
    padding-bottom: 10px;
    margin-bottom: 10px;
    .article-name{
        width: 40%;
    };
    .article-qty{
        width: 10%;
    };
    .article-total{
        width: 10%;
        text-align: right;
    }
    .article-btn{
        width:40%;
    }
}

</style>
