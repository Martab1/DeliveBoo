<template>
    <div class="all-container container">
        <div class="payment">
            <div class="section-payment" v-if=loader>
                <h1>Completa il tuo acquisto</h1>
                <img src="/site_img/cool_avocado.png" alt="cool avocado">
                <v-form class="sub-container">
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
                                    v => /^(([^<>()[\]\\.,;:\s@']+(\.[^<>()\\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'Inserisci una mail valida',
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
                        <h2>Importo complessivo: {{this.$route.params.orderTotal}} 
                            <span v-if="!this.$route.params.orderTotal">0</span> €
                        </h2>
                        <v-braintree
                            class="braintree"
                            locale="it_IT"
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
            <div v-else class="loading">
                <v-progress-circular
                :size="70"
                color="#C4007A"
                indeterminate
                ></v-progress-circular>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"Payment",
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
        }
    },
    mounted(){
        this.generateKey();
        this.paymentCart();
    },
    methods:{
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
            alert("dati della carta non inseriti correttamente");
        },
        async buy(){
            try{
                axios.post("http://127.0.0.1:8000/api/orders/make/payment", {...this.form})
                .then(res=>{
                    localStorage.clear();
                    if(res.data.errors){
                        alert("attenzione, qualche dato non è inserito correttamente: ");
                        this.errors = res.data.errors;
                        this.any_errors= true;
                        this.loader = true;
                    }else{
                        this.any_errors= false;
                        return this.$router.push("/checkout/success");
                    }
                })
                .catch(err=>{
                    alert("mi dispiace...qualcosa è andato storto....");
                    return this.$router.push("/checkout/error");
                });
            }catch(error){
               this.loader = false;        
            }
        },
        paymentCart(){
            let contents = JSON.parse(localStorage.getItem(this.$route.params.restaurantId));
            contents.forEach(product=>{
                this.form.products.push({
                    productId : product.id,
                    qty : product.qty,
                    });
            })
        }
    },
}
</script>

<style lang="scss" scoped>
@import "../../sass/vars.scss";
@import "../../sass/mixins.scss";
.all-container{
    margin-top: 20px;
    margin-bottom: 20px;
    height: calc(100% - 40px);
    @include flex("flex");
}

.payment{
    text-align: center;
    color: white;
    width: 70%;
    height: 100%;
    background-color: $content-color;
    border: 2px solid $layout-color;
}

img{
    width: 7%;
    margin-bottom: 8px;
    margin-top: 8px;
}

h2{
    color: #0f0e17;
    margin-top: 30px;
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
}

.sub-container{
    background-color: $special-white;
    border: 2px solid $layout-color;
    padding: 20px;
    margin: 0 auto;
    max-width: 70%;
}

#btn{
    background-color: $layout-color;
}

.loading{
    height: 100%;
    @include flex("center");
}

// PER I MEDIA QUERY FARE SPARIRE CARRELLO
@media screen and (max-width:999px){
    .payment{
        width: 100%;
    }
    .sub-container{
        max-width: 90%;
        padding: 8px;
    }
}

@media screen and (max-width:438px){
    img{
        width: 15%;
    }
}

</style>