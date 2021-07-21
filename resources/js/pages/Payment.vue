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
                </div>
                <div>
                    <label for="payer_email">Email: </label>
                    <input type="text" required id="payer_email" v-model="form.payer_email">
                </div>
                <div>
                    <label for="payer_address">Address: </label>
                    <input 
                    type="text" id="payer_address" v-model="form.payer_address">
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
            this.form.token = payload.nonce;
            this.buy();
        },
        onError (error) {
            let message = error.message;
            alert("messaggio1 " + message);
        },
        async buy(){
            try{
                axios.post("http://127.0.0.1:8000/api/orders/make/payment", {...this.form})
                .then(res=>{
                    localStorage.clear();
                    return this.$router.push("/checkout/success");
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
            console.log(this.$route.params.orderTotal);
        }
    }
}
</script>

<style>


</style>