<template>
    <div v-if="loader" class="all-container container">
        <div class="h-100">
            <!-- <div class="payment"> -->
                <div class="section-payment">
                    <v-form class="sub-container">
                        <h2>Completa il tuo acquisto</h2>
                                <template>
                                    <!-- INPUT NAME -->
                                    <v-text-field
                                    class="input"
                                    label="nome"
                                    v-model="form.payer_name"
                                    :rules="[
                                        v => !!v || 'Nome obbligatorio',
                                        v => (v && v.length <= 50) || 'Il nome può contenere massimo 50 caratteri',
                                        v => (v && v.length >= 3) || 'Il nome deve contenere minimo 3 caratteri'
                                    ]"
                                    hide-details="auto"
                                    ></v-text-field>
                                    <!-- ERROR -->
                                    <div v-show="any_errors">
                                        <v-alert class="alert" type="error" v-for="error in errors['payer_name']" :key="error">
                                        {{error}}
                                        </v-alert>
                                    </div>
                                    <!-- INPUT EMAIL -->
                                    <v-text-field
                                    class="input"
                                    v-model="form.payer_email"
                                    label="email"
                                    :rules="[
                                        v => !!v || 'Email obbligatoria',
                                        v => /^(([^<>()[\]\.,;:\s@']+(\.[^<>()\[\]\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'Inserisci una mail valida',
                                    ]"
                                    hide-details="auto"
                                    ></v-text-field>
                                    <!-- ERROR -->
                                    <div v-show="any_errors">
                                        <v-alert class="alert" type="error" v-for="error in errors['payer_email']" :key="error">
                                        {{error}}
                                        </v-alert>
                                    </div>
                                    <!-- INPUT ADDRESS -->
                                    <v-text-field
                                    class="input"
                                    v-model="form.payer_address"
                                    label="indirizzo di consegna"
                                    :rules="[
                                        v => !!v || 'Indirizzo obbligatorio',
                                        v => (v && v.length <= 200) || 'l\'indirizzo può contenere massimo 50 caratteri',
                                        v => (v && v.length >= 3) || 'l\'indirizzo deve contenere minimo 3 caratteri'
                                    ]"
                                    hide-details="auto"
                                    ></v-text-field>
                                    <!-- ERROR -->
                                    <div v-show="any_errors">
                                        <v-alert class="alert" type="error" v-for="error in errors['payer_address']" :key="error">
                                        {{error}}
                                        </v-alert>
                                    </div>
                                </template>
                            <h2 class="total-payment">Importo: {{this.$route.params.orderTotal}}
                                <span v-if="!this.$route.params.orderTotal">0</span> €
                            </h2>
                            <v-braintree
                                class="braintree"
                                locale="it_IT"
                                :vaultManager="true"
                                :authorization=tokenApi
                                @success="onSuccess"
                                @error="onError"
                                >
                                <template v-slot:button="slotProps">
                                    <v-btn @click="slotProps.submit" elevation="2" id="btn">Paga subito</v-btn>
                                </template>
                            </v-braintree>
                    </v-form>
                </div>
            <!-- </div> -->
            <div class="my_order">
                <h2>Il tuo ordine</h2>
                <div class="sub-container-my-order">
                    <span v-for="article in my_order" :key="article.id">
                        <div class="container-articles">
                            <div class="article-name">{{article.name}}</div>
                            <div class="article-qty">qtà: {{article.qty}}</div>
                            <div class="article-total">€ {{article.total}}</div>
                        </div>
                            <v-divider></v-divider>
                    </span>
                </div>
                <h4 class="slogan">Completa l'acquisto e ricevilo subito a casa!</h4>
            </div>
        </div>
    </div>
    <div v-else class="loading">
        <v-progress-circular
        :size="70"
        color="#ff8e3c"
        indeterminate
        ></v-progress-circular>
    </div>
</template>

<script>
export default {
    // name:"Payment",
    data(){
        return{
            tokenApi: "",
            loader: false,
            form : {
                token : "",
                products : [],
                restaurantId : this.$route.params.restaurantId,
                payer_name : "",
                payer_email : "",
                payer_address : "",
            },
            errors: {},
            any_errors: false,
            my_order : [],
        }
    },
    mounted(){
        this.controll();
        this.generateKey();
        this.paymentCart();
    },
    methods:{
        controll(){
            if(!this.$route.params.restaurantId){
                return this.$router.push("*");
            }
        },
        async generateKey(){
            this.loader = false;
            await axios.get("http://127.0.0.1:8000/api/orders/generate")
            .then(res=>{
                this.tokenApi = res.data.token;
                this.loader = true;
            }).catch(err=>{
                console.log(err);
            })
        },
        onSuccess (payload) {
            this.loader = false;
            this.form.token = payload.nonce;
            this.buy();
        },
        onError (error) {
            let message = error.message;
        },
        async buy(){
            try{
                axios.post("http://127.0.0.1:8000/api/orders/make/payment", {...this.form})
                .then(res=>{
                    localStorage.clear();
                    if(res.data.errors){
                        this.errors = res.data.errors;
                        this.any_errors= true;
                        this.loader = true;
                    }else{
                        this.any_errors= false;
                        return this.$router.push("/checkout/success");
                    }
                })
                .catch(err=>{
                    return this.$router.push("/checkout/error");
                });
            }catch(error){
               this.loader = false;        
            }
        },
        paymentCart(){
            let contents = JSON.parse(localStorage.getItem(this.$route.params.restaurantId));
            this.my_order = contents;
            contents.forEach(product=>{
                this.form.products.push({
                    productId : product.id,
                    qty : product.qty,
                    });
            })
        },
    },
}
</script>

<style lang="scss" scoped>
@import "../../sass/vars.scss";
@import "../../sass/mixins.scss";
.all-container{
    padding: 30px;
    min-height: calc(100vh - 166px - 108px);
}

.section-payment{
    flex-grow: 1;
}

img{
    width: 7%;
    margin-bottom: 8px;
    margin-top: 8px;
}

.input{
    background-color: $special-white;
    margin: 0;
}

.alert{
    background-color: $special-white;
    margin: 0;
}

.braintree{
    width: 100%;
    margin: 0;
    padding: 0;
    border: transparent;
    background-color: $special-white;
    text-align: center;
}

.sub-container{
    background-color: $special-white;
    min-height: 100%;
    padding: 10px 80px;
    margin: 0 auto;
    box-shadow: 0 12px 16px -20px rgb(0, 0, 0, 1);
    & > h2:first-child{
        text-align:center;
        text-transform: uppercase;
    }
}

.total-payment{
    margin-top: 30px;
    color: $special-black;
}

#btn{
    margin-top: 5px;
}

#btn:hover{
    background-color: $btn-color;
    color: white;
}

.loading{
    height: 100%;
    @include flex("center");
}

.my_order{
    flex-basis: 25%;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    margin-left: 20px;
    padding: 10px 20px;
    max-height: 100%;
    background-color: $special-white;
    box-shadow: 0 12px 16px -20px rgb(0, 0, 0, 1);
    h2{
        text-align: center;
        text-transform: uppercase;
    }
}

.h-100{
    height: 100%;
    @include flex("flex");
}

.sub-container-my-order{
    height: 75%;
    margin-top: 30px;
    padding: 20px;
    overflow-y: auto;
    text-transform: capitalize;
}

.container-articles{
    @include flex("flex");
    padding: 8px 0px;
    margin: 8px 0px;
    .article-name{
        width: 60%;
    };
    .article-qty{
        width: 20%;
    };
    .article-total{
        width: 20%;
        text-align: right;
    }
}

.slogan{
    margin:30px 0;
    text-align: center;
    font-size: $special-black2;
}
// PER I MEDIA QUERY FARE SPARIRE CARRELLO
@media screen and (max-height:812px){
    .all-container{
    height: unset;
    }
}

@media screen and (max-width:1903px){
    .all-container{
    padding: 30px 15px;
    }
    .my_order{
        flex-basis: 40%;
    }
}

@media screen and (max-width:1263px){
    .my_order{
        flex-basis: 60%;
    }
}

@media screen and (max-width:896px){
    .my_order{
        display: none;
    }
}

@media screen and (max-width:541px){
    h2{
        font-size: 1.1rem;
    }
    .sub-container{
        padding: 15px;
    }
}

</style>