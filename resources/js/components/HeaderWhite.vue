<template>
  <header>
    <div class="my_container">
      <router-link :to="{name:'home'}" class="logo">
        <img src="/img/deliveboo_white.png" alt="logo">
        <span>
        Deliveboo
        </span>
      </router-link >
      <div class="actions">
        <div id="hide">
          <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M3 10L5 8.44444V5H9.42857L12 3L21 10V21H3V10ZM14 19H19V10.9782L12 5.53372L5 10.9782V19H10V14H14V19Z"></path></svg>
          Registrati o accedi</div>
        <div id="menu">
          <svg height="22" width="22" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M2 13V11H22V13H2ZM2 19V17H22V19H2ZM2 7V5H22V7H2Z"></path></svg>
          Menu
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
   name: 'HeaderWhite',
   data(){
    return{
      drop_collaborates: false,
    }
   },
   methods:{  
     openDropCollaborates(){
       this.drop_collaborates = !this.drop_collaborates;
     }
   }
}
</script>

<style scoped lang="scss">
@import '../../sass/vars.scss';
@import '../../sass/mixins.scss';

// UTILITIES
.relative{
  position: relative;
}


header{
  height: 66px;
  background-color: #fff;
  border-bottom: 1px solid $d-grey;
  .my_container{
    height: 100%;
    @include flex("space-bet");
    align-items: center;
    .logo{
      text-decoration: none;
      width: 110px;
      @include flex("center");
      cursor: pointer;
      img{
        width: 25px;
      }
      span{
        font-weight: bold;
        color: $d-primary;
        margin-left: 8px;
      }
    }
    .actions{
      @include flex("flex");

      & > div,
      & > span {
        @include flex("vertical");
        background-color: #fff;
        margin: 16px 7px;
        border-radius: 4px;
        padding: 8px 16px;
        cursor: pointer;
        border: 1px solid $d-grey;
        svg{
          width: 18px;
          height: 18px;
          margin-right: 8px;
          color: $d-primary;
          fill: currentColor;
        }
      }
      span > div:first-child{
        @include flex("vertical");
      }
      .drop-collaborates{
        background-color: #fff;
        @include flex("column");
        position: absolute;
        width: 130%;
        top: 43px;
        left: 0;
        & > div{
          padding: 8px 0px 8px 16px;
        }
      }
    }
  }
}

@media screen and (max-width: 670px){
  #hide{
    display: none;
  }

  #menu{
    font-size: 14px;
  }
}


</style>