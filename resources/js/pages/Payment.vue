<template>
    <div class="container">
    <div v-if=loader>
        <div>Importo da pagare = {{this.$route.params.orderTotal}}</div>
        <v-braintree 
            locale="it_IT"
            :authorization=tokenApi
            @success="onSuccess"
            @error="onError"
            btnText="paga subito">
        </v-braintree>
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
                    console.log(res.data)
                })
                .catch(err=>{
                    alert("messaggio2 " + err.message)
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