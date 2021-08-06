<template>
    <div class="error404">
      <div class="content">
        <img src="https://deliveroo.it/assets/images/error-pages/roo-5c784b3ea96399e6269af8a11ec6349c.svg" alt="">
        <h1>Pagina non trovata</h1>
        <div>Siamo spiacenti, la pagina che stai cercando non esiste. <br>
          Ma c'è molto altro da vedere!
        </div>
        <router-link :to="{name:'home'}"><button>Vai alla home</button></router-link>
      </div>
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
  .error404{
    background: url("https://deliveroo.it/assets/images/error-pages/background-7edaa013aceff22965bdb7fbf274b4a2.svg") repeat-x 0 0;
    height: 100vh;
    padding-top: 135px;
    .content{
      text-align: center;
      max-width: 30%;
      margin: 0 auto;
      img{
        margin-bottom: 30px;
      }
      h1{
        font-size: 40px;
      }
      & > div{
        font-size: 16px;
        margin-bottom: 30px;
      }
      button{
        padding: 0.5em 1em;
        border-radius: 4px;
        background-color: $d-primary;
        color: #fff;
        font-weight: bold;
        margin-bottom: 20px;
      }
    }
  }

  @media screen and (max-width: 851px){
  .error404{
    .content{
      max-width: 60%;

      h1{
        font-size: 36px;
      }
    }
  }
}
</style>