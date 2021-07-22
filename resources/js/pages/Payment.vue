<template>
    <div>
        <div v-if=loader>
            <div>Importo da pagare = {{this.$route.params.orderTotal}}</div>
            <form>
                <div>
                    <label for="payer_name">Name: </label>
                    <input   
                    type="text" id="payer_name" 
                    v-model="form.payer_name">
                    <!-- ERROR -->
                <div v-show="any_errors">
                    <span v-for="error in errors['payer_name']" :key="error" >{{error}}</span>
                </div>
                </div>
                <div>
                    <label for="payer_email">Email: </label>
                    <input type="text" required id="payer_email" v-model="form.payer_email">
                    <!-- ERROR -->
                    <div v-show="any_errors">
                    <span v-for="error in errors['payer_email']" :key="error" >{{error}}</span>
                    </div>
                </div>
                <div>
                    <label for="payer_address">Address: </label>
                    <input 
                    type="text" id="payer_address" v-model="form.payer_address">
                    <!-- ERROR -->
                     <div v-show="any_errors">
                    <span v-for="error in errors['payer_address']" :key="error" >{{error}}</span>
                    </div>
                </div>
                <v-braintree
                    locale="it_IT"
                    :authorization=tokenApi
                    @success="onSuccess"
                    @error="onError"
                    btnText="paga subito">
                </v-braintree>
            </form>
        </div>
        <div v-else>loading...</div>
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
    }
}
</script>

<style>

</style>