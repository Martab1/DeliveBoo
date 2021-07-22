<template>
  <div class="payment-error container">
    <h1>Mi dispiace, il pagamento non è avvenuto correttamente</h1>
    <img src="/site_img/error_avocado.png" alt="happy-avocado">
    <h2>Ricontrolla i dati inseriti o ritenta con un altra carta</h2>
    <h2>Grazie</h2>
      <router-link :to="{name:'home'}">
          <v-btn
          id="btn"
          elevation="2"
          >
              Torna alla home
          </v-btn>
        </router-link>
  </div>
</template>

<script>
export default {
   name:"CheckoutError",
}
</script>

<style lang="scss" scoped>
@import "../../sass/vars.scss";
@import "../../sass/mixins.scss";

.payment-error{
  text-align: center;
  color: white;
  margin-top:20px;
  margin-bottom:20px;
  height: calc(100% - 40px);
  background-color: $layout-color;
  @include flex("column-center");
}

img{
  margin: 10px 0;
  width: 15%;
}

#btn{
  margin: 10px 0;
  background-color: $btn-color;
}

@media screen and (max-width:680px){
    .payment-error{
      font-size: 0.7rem;
    };
}

@media screen and (max-width:438px){
    .payment-error{
      font-size: 0.6rem;
    };
    h2{
      margin-bottom: 5px;
    }
    img{
      width: 20%;
    }
}

</style>