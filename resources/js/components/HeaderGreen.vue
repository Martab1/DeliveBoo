<template>
  <header>
    <div class="my_container">
      <router-link :to="{name: 'home'}" class="logo">
        <img src="/img/logo_transparent.png" alt="logo">
        <span>
        Deliveboo
        </span>
      </router-link>
      <div class="actions">
        <div>
          <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M2 13V11H22V13H2ZM2 19V17H22V19H2ZM2 7V5H22V7H2Z"></path></svg>
          Menu
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
   name: 'HeaderGreen',
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
  width: 100%;
  height: 66px;
  background-color: #006d68;
  .my_container{
    height: 100%;
    @include flex("space-bet");
    align-items: center;
    .logo{
      text-decoration: none;
      @include flex("center");
      width: 120px;
      cursor: pointer;
      img{
        width: 25px;
      }
      span{
        font-weight: bold;
        color: #fff;
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
        a{
          text-decoration: none;
          color: black;
        }
      }
    }
  }
}


</style>