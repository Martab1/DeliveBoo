<template>
  <div class="payment-success container">
    <h1>Pagamento avvenuto con successo!</h1>
    <img src="/site_img/happy_avocado.png" alt="happy-avocado">
    <h2>A breve riceverai un email con la conferma d'ordine</h2>
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
   name:"CheckoutSuccess",
}
</script>

<style lang="scss" scoped>
@import "../../sass/vars.scss";
@import "../../sass/mixins.scss";

.payment-success{
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
  width: 10%;
}

#btn{
  margin: 10px 0;
  background-color: $btn-color;
}

@media screen and (max-width:680px){
    .payment-success{
      font-size: 0.7rem;
    };
}

@media screen and (max-width:438px){
    .payment-success{
      font-size: 0.6rem;
    };
    h2{
      margin-bottom: 5px;
    }
    img{
      width: 15%;
    }
}

</style>