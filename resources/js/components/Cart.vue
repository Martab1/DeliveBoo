<template>
    <section>
        <div class="vertical-center"> 
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
        <v-divider></v-divider>
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
}

.container-articles{
    @include flex("vertical");
    margin-bottom: 8px;
    padding:8px 0;
    width: 100%;
    .article-name{
        width: 45%;
        padding-right: 8px;
        word-wrap: break-word;
    };
    .article-qty{
        width: 15%;
    };
    .article-total{
        width: 20%;
        text-align: right;
        padding-right: 12px;
    }
    .article-btn{
        width:20%;
        text-align: right;
    }
}

@media screen and (max-width:447px) {
    .container-articles{
        .article-name{
            border: 1px solid #000;
            width: 38%;
        }
        .article-btn{
            border: 1px solid #000;
            width:28%;
        }
    }
}


</style>
