<template>
    <div class="container">
    <div v-if=loader>
        <v-braintree 
            locale="it_IT"
            :authorization=tokenApi
            @success="onSuccess"
            @error="onError">
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
                amount : "4.00",
            },
        }
    },
    created(){
        this.generateKey();
        console.log("created " + this.tokenApi);
    },
    methods:{
        async generateKey(){
            this.loader = false;
            await axios.get("http://127.0.0.1:8000/api/orders/generate")
            .then(res=>{
                this.tokenApi = res.data.token;
                console.log("token " + res.data.token);
                console.log("after " + this.tokenApi);
                this.loader = true;
            }).catch(err=>{
                console.log(err);
            })
        },
        onSuccess (payload) {
            // let token = payload.nonce;
            this.form.token = payload.nonce;
            this.buy();
            // Do something great with the nonce...
        },
        onError (error) {
            let message = error.message;
            alert("messaggio1" + message);
            // Whoops, an error has occured while trying to get the nonce
        },
        async buy(){
            try{
                axios.post("http://127.0.0.1:8000/api/orders/make/payment")
                .then(res=>{
                    alert("SUCCESSO")
                })
                .catch(err=>{
                    alert("messaggio2" + err)
                });
            }catch(error){
               this.loader = false;        
            }
        }
    }
}
</script>

<style>

</style>