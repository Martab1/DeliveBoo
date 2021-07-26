<template>
  <div class="payment-success container">
    <i class="icon fas fa-times"></i>
     <h1>Qualcosa è andato storto...</h1>
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
   name:"NotFound",
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
  font-size: 8rem;
  margin: 10px 0;
  color: rgb(224, 38, 38);
}

#btn{
  margin-top: 50px;
  background-color: $btn-color;
  color: white;
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