<template>
  <div class="payment-success container">
    <i class="icon fas fa-exclamation-circle"></i>
    <h1>Mi dispiace</h1>
    <h2>Il pagamento non è avvenuto correttamente</h2>
      <router-link id="a" :to="{name:'home'}">
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

.payment-success{
  text-align: center;
  width: 50%;
  color: $special-black2;
  margin-top:20px;
  margin-bottom:20px;
  height: calc(100% - 40px);
  background-color: $special-white;
  @include flex("column-center");
}

.icon{
  font-size: 5rem;
  margin: 10px 0;
  color: rgb(224, 38, 38);
}

#btn{
  margin-top: 50px;
  background-color: $btn-color;
  color: white;
}

#a{
  text-decoration: none;
}

@media screen and (max-width:1903px){
     .payment-success{
      width: 80%;
    };
}

@media screen and (max-width:766px){
    h1{
      font-size: 1.4rem;
    }
    h2{
      font-size: 1.2rem;
    }
}

@media screen and (max-width:531px){
    h2{
      margin-top: 20px
    }
}

</style>