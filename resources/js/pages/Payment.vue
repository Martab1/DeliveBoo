<template>
    <div v-if="loader" class="payment">
        <HeaderGreen/>
        <div class="my_container">
            <div class="left" v-if="this.$route.params.restaurant">
                <h1>{{this.$route.params.restaurant.name}}</h1>
                <div class="time">
                    <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-abe5c41af1b9498e ccl-be253fe60aa767f4"><path d="M13 12L15.2025 15.8789L13.4704 16.8789L11 12.6V6H13V12ZM12 2C17.5228 2 22 6.47717 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47717 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20Z"></path></svg>
                    Consegna fra 30 - 45 min
                </div>
                    <v-form class="form">
                        <template>
                            <div class="silverware">
                                <label class="switch">
                                    <input @click="checked" type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                                <div class="text-silverware">
                                    <h4>Posate</h4>
                                    <span v-if="check">Il ristorante aggiungerà le posate per te, se disponibili.</span>
                                    <span v-else>Aiutaci a ridurre lo preco di plastica: richiedi le posate solo quando ne hai bisogno.</span>
                                </div>
                            </div>
                            <h2>Indirizzo di consegna</h2>
                            <!-- INPUT ADDRESS -->
                            <label for="address">Indirizzo</label>
                            <v-text-field
                            class="input"
                            id="address"
                            placeholder="es.Via Ettore Ponti, 21"
                            v-model="form.payer_address"
                            color="#006d68"
                            :rules="[
                                v => !!v || 'Indirizzo obbligatorio',
                                v => (v && v.length <= 50) || 'l\'indirizzo può contenere massimo 50 caratteri',
                                v => (v && v.length >= 3) || 'l\'indirizzo deve contenere minimo 3 caratteri'
                            ]"
                            hide-details="auto"
                            ></v-text-field>
                            <!-- ERROR -->
                            <div class="form-error" v-show="any_errors">
                                <span v-for="error in errors['payer_address']" :key="error">
                                    {{error}}
                                </span>
                            </div>
                            <!-- CAP AND CITY -->
                            <div class="cap-and-city" id="cap-and-city">
                                <div class="cap" id="cap">
                                    <label for="cap">Cap</label>
                                    <v-text-field
                                    class="input"
                                    id="cap"
                                    v-model="form.payer_cap"
                                    placeholder="es. 20143"
                                    color="#006d68"
                                    :rules="[
                                        v => !!v || 'Cap obbligatorio',
                                        v => (v && v.length == 5) || 'Il Cap deve contenere 5 numeri',
                                        v => /^\d+$/.test(v) || 'Il Cap deve contenere solo numeri',
                                    ]"
                                    hide-details="auto"
                                    ></v-text-field>
                                    <!-- ERROR -->
                                    <div class="form-error" v-show="any_errors">
                                        <span v-for="error in errors['payer_cap']" :key="error">
                                        {{error}}
                                        </span>
                                    </div>
                                </div>
                                <div class="city" id="city">
                                    <label for="city">Città</label>
                                    <v-text-field
                                    class="input"
                                    id="city"
                                    v-model="form.payer_city"
                                    placeholder="es. Milano"
                                    color="#006d68"
                                    :rules="[
                                        v => !!v || 'Città obbligatoria',
                                        v => (v && v.length <= 50) || 'La città può contenere massimo 50 caratteri',
                                        v => (v && v.length >= 3) || 'La città deve contenere minimo 3 caratteri'
                                    ]"
                                    hide-details="auto"
                                    ></v-text-field>
                                    <!-- ERROR -->
                                    <div class="form-error" v-show="any_errors">
                                        <span v-for="error in errors['payer_city']" :key="error">
                                        {{error}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- NAME AND EMAIL -->
                            <div class="name-and-email" id="name-and-email">
                                <div class="name" id="name">
                                    <label for="nome">Nome</label>
                                    <v-text-field
                                    class="input"
                                    color="#006d68"
                                    placeholder="es. Luigi Verdi"
                                    v-model="form.payer_name"
                                    :rules="[
                                        v => !!v || 'Nome obbligatorio',
                                    ]"
                                    hide-details="auto"
                                    ></v-text-field>
                                    <!-- ERROR -->
                                    <div class="form-error" v-show="any_errors">
                                        <span v-for="error in errors['payer_name']" :key="error">
                                        {{error}}
                                        </span>
                                    </div>
                                </div>
                                <div class="email" id="email">
                                    <label for="email">Email</label>
                                    <v-text-field
                                    class="input"
                                    color="#006d68"
                                    v-model="form.payer_email"
                                    placeholder="es. verdiluigi@gmail.com"
                                    :rules="[
                                        v => !!v || 'Email obbligatoria',
                                        v => /^(([^<>()[\]\.,;:\s@']+(\.[^<>()\[\]\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'Inserisci una mail valida',
                                    ]"
                                    hide-details="auto"
                                    ></v-text-field>
                                    <!-- ERROR -->
                                    <div class="form-error" v-show="any_errors">
                                        <span v-for="error in errors['payer_email']" :key="error">
                                        {{error}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    <h2 class="payment-method">Metodo di pagamento</h2>
                    <v-braintree
                        class="braintree"
                        locale="it_IT"
                        :vaultManager="true"
                        :authorization=tokenApi
                        @success="onSuccess"
                        @error="onError"
                        >
                        <template v-slot:button="slotProps">
                            <v-btn class="submit" @click="slotProps.submit">
                                <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205"><path d="M18 9H20V21H4V9H6C6 5.69158 8.69158 3 12 3C15.3084 3 18 5.69158 18 9ZM6 19H18V11H6V19ZM8 9H16C16 6.79442 14.2056 5 12 5C9.79442 5 8 6.79442 8 9ZM11.5 16V14H12.5V16H11.5Z"></path></svg>
                                Ordina per la consegna
                            </v-btn>
                        </template>
                    </v-braintree>
                </v-form>
            </div>
            <div class="right">
                <!-- CART -->
                <div class="cart">
                    <div class="container-cart">
                        <h4>Carrello</h4>
                        <div class="recap" v-for="product in my_order" :key="product.id">
                            <div class="qty">
                                {{product.qty}}x
                            </div>
                            <div class="name">{{product.name}}</div>
                            <div class="single-total">{{product.total}} €</div>
                        </div>
                        <div class="subtotal">
                            <span>Subtotale</span>
                            <span>{{this.$route.params.orderTotal}}  €</span>
                        </div>
                        <div class="transportation-fee">
                            <span>Spese di trasporto</span>
                            <span>
                                <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-1e6f880f67285c2e"><path d="M12 2C17.5228 2 22 6.47717 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47717 6.47717 2 12 2ZM12 20C16.4112 20 20 16.4112 20 12C20 7.5888 16.4112 4 12 4C7.5888 4 4 7.5888 4 12C4 16.4112 7.5888 20 12 20ZM11 17V10H13V17H11ZM11.9934 6.69997C12.7444 6.69997 13.2846 7.22697 13.2846 7.91205C13.2846 8.59722 12.7444 9.13738 11.9934 9.13738C11.2556 9.13738 10.7155 8.59722 10.7155 7.91205C10.7155 7.22697 11.2556 6.69997 11.9934 6.69997Z"></path></svg>
                                <span class="delete">1,49 € </span>
                                <span class="free">Gratuito</span>
                            </span>
                        </div>
                    </div>
                    <div class="savings">
                        Con la consegna gratuita risparmi 1,49 €
                    </div>
                    <div class="total">
                        <span>Totale</span>
                        <span>{{this.$route.params.orderTotal}}  €</span>
                    </div>
                </div>
            </div>
        </div>
        <Footer/>
    </div>
    <div v-else class="loading">
        <v-progress-circular
        :size="70"
        color="#00ccbc"
        indeterminate
        ></v-progress-circular>
    </div>
</template>

<script>
import HeaderGreen from "../components/HeaderGreen.vue";
import Footer from "../components/Footer.vue";
export default {
    name:"Payment",
    components:{
        HeaderGreen,
        Footer,
    },
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
                payer_cap : "",
                payer_city : "",
            },
            errors: {},
            any_errors: false,
            my_order : [],
            check : false,
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
                return this.$router.push("/");
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
        checked(){
            this.check =! this.check;
            console.log("ciao");
        }
    },
}
</script>

<style lang="scss" scoped>
@import "../../sass/vars.scss";
@import "../../sass/mixins.scss";

.payment{   
    background: rgb(0,109,104);
    background: linear-gradient(176deg, rgba(0,109,104,1) 21.8%, rgba(244,246,245,1) 22%);
    .my_container{
        padding-bottom: 40px;
        @include flex("flex");
        .left{
            flex-grow: 1;
            h1{
                color: #fff;
                font-size: 28px;
            }
            .time{
                @include flex("vertical");
                color: #fff;
                fill: currentColor;
                margin-bottom: 26px;
                svg{
                    width: 20px;    
                    height: 20px;
                    margin-right: 4px;
                }
            }
            .form{
                padding: 41px;
                background-color: #fff;
                .form-error{
                    color: #ff5252;
                }
                .silverware{
                    @include flex("vertical");
                    margin-bottom: 43px;
                    padding: 16px;
                    border-radius: 3px;
                    border: solid 1px $d-border;
                    .switch {
                    position: relative;
                    display: inline-block;
                    min-width: 42px;
                    height: 28px;
                    }

                    .switch input { 
                    opacity: 0;
                    width: 0;
                    height: 0;
                    }

                    .slider {
                    position: absolute;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: #a3afaf;
                    transition: .4s;
                    }

                    .slider:before {
                    position: absolute;
                    @include flex("center");
                    content: "✖";
                    color: #a3afaf;
                    height: 20px;
                    width: 20px;
                    left: 4px;
                    bottom: 4px;
                    background-color: white;
                    transition: .4s;
                    }

                    input:checked + .slider {
                    background-color: #00ccbc;
                    }

                    input:focus + .slider {
                    box-shadow: 0 0 1px #00ccbc;
                    }

                    input:checked + .slider:before {
                    transform: translateX(15px);
                    @include flex("center");
                    content: "✔";
                    color: #00ccbc;;
                    }

                    .slider.round {
                    border-radius: 34px;
                    }

                    .slider.round:before {
                    border-radius: 50%;
                    }
                    .text-silverware{
                        margin-left: 10px;
                        color: $d-text-grey;
                        font-size: 14px;
                        h4{
                            color: $d-black;
                        }
                        input:checked + span{
                            content: "ciao"
                        }
                    }
                }
                h2{
                    color: $d-black;
                    font-size: 22px;
                    margin-bottom: 19px;
                }
                & > label{
                    font-size: 14px;
                    color: $d-text-grey;
                }
                .input{
                    padding: 4px;
                    border-radius: 3px;
                    border: solid 1px $d-border;
                }
                .cap-and-city,
                .name-and-email{
                    margin: 24px 0;
                    @include flex("flex");
                    & label{
                        font-size: 14px;
                        color: $d-text-grey;
                    }
                    .cap,
                    .name{
                        width: 48%;
                        margin-right: 4%;
                    }
                    .city,
                    .email{
                        width: 48%;
                    }
                }
                .payment-method{
                    margin-bottom: 0;
                }
                .braintree{
                    background: none;
                    margin: 0;
                    padding: 0;
                    text-align: center;
                    .submit{
                        text-transform: lowercase;
                        @include flex("vertical");
                        width: 100%;
                        background-color: $d-primary;
                        color: #fff;
                        svg{
                            fill:currentColor;
                            width: 20px;
                            height: 20px;
                            margin-right: 8px;
                        }
                    }
                }
            }
        }
        .right{
            width: 395px;
            margin-left: 20px;
            .cart{
            min-height: 248px;
            background-color: #fff;
                .container-cart{
                    padding: 16px;
                    h4{
                        color: $d-black;
                        font-size: 18px;
                    }
                    .recap{
                        margin: 20px 0;
                        @include flex("vertical");
                        .qty{
                            width: 10%;
                            color: $d-text-grey;
                        }
                        .name{
                            width: 65%;
                        }
                        .single-total{
                            width: 25%;
                            text-align: right;
                        }
                    }
                    .subtotal{
                    margin-top: 25px;
                    @include flex("flex");
                        & > span:first-child{
                            color: #828585;
                        }
                        & > span:last-child{
                            display: block;
                            width: 100%;
                            text-align: right;
                        }
                    }
                    .transportation-fee{
                        margin: 4px 0;
                        @include flex("flex");
                        color: #828585;
                        & > span:last-child{
                            @include flex("vertical");
                            justify-content: flex-end;
                            flex-grow: 1;
                            svg{
                                fill: currentColor;
                                width: 18px;
                                height: 18px;
                                margin-right: 4px;
                            }
                            .delete{
                                text-decoration: line-through;
                                margin-right: 4px;
                            }
                            .free{
                                color: #e2484f;
                            }
                        }
                    }
                }
                .savings{
                    @include flex("center");
                    padding: 10px;
                    background-color: #00a396;
                    color: white;
                }
                .total{
                    color: $d-text-grey;
                    @include flex("flex");
                    padding: 8px 16px;
                    & >span:last-child{
                        width: 100%;
                        text-align: right;
                        color: black;
                    }
                }
            }
        }
    }
}

.loading{
    height: 100vh;
    @include flex("center");
}

@media screen and (max-width: 892px) {
    .payment{
        .my_container{
            .right{
                display: none;
            }
        }
    }
}

@media screen and (max-width: 580px){
    #cap-and-city{
        margin: unset;
        margin-top: 24px;
    }

    #name-and-email{
        margin: unset;
    }

    #cap-and-city,
    #name-and-email{
        @include flex("flex");
        flex-wrap: wrap;
        #cap,
        #name{
            width: 100%;
            margin: unset;
            margin-bottom: 20px;

        }
        #city,
        #email{
            width: 100%;
            margin-bottom: 20px;
        }
    }
}
</style>