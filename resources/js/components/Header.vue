<template>
  <header>
    <div class="my_container">
      <router-link :to="{name: 'home'}" class="logo">
        <img src="/img/logow-notext.png" alt="logo">
        <span>
        Deliveboo
        </span>
      </router-link>
      <div class="actions">
        <span class="relative">
          <div @click="openDropCollaborates()">
            <svg v-if="drop_collaborates" height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M12.0001 9.76777L19.1162 16.8839L20.884 15.1161L12.0001 6.23223L3.11621 15.1161L4.88398 16.8839L12.0001 9.76777Z"></path></svg>
            <svg v-else height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M4.88398 7.11612L3.11621 8.88389L12.0001 17.7678L20.884 8.88389L19.1162 7.11612L12.0001 14.2322L4.88398 7.11612Z"></path></svg>
            Collabora con noi
          </div>
          <div v-show="drop_collaborates" class="drop-collaborates">
            <div>
              <a href="http://127.0.0.1:8000/admin">
                <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M15.55 11.8642L13.8012 13.6129L19.749 20.3375L18.2509 21.6625L12.3844 15.0298L5.70707 21.7071L4.29286 20.2929L11.0568 13.5289L9.67929 12.112L6.93679 14.8345L2.99365 8.15994L4.35279 2.93054L12.4737 12.112L14.1358 10.45L12.7929 9.1071L12.8008 7.68498L17.3008 3.28498L18.6991 4.715L14.9222 8.40798L15.55 9.03578L19.2929 5.29288L20.7071 6.7071L16.9642 10.45L17.5079 10.9937L21.3008 7.28498L22.6991 8.715L18.1991 13.115L16.7929 13.1071L15.55 11.8642ZM5.34352 7.06944L5.14324 7.84003L7.32097 11.6642L8.40646 10.6124L5.34352 7.06944Z"></path></svg>
                Ristoranti
              </a>
            </div>
            <div>
              <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M17 3H7V6H2V20H22V6H17V3ZM15 6H9V5H15V6ZM4 8H20V11H4V8ZM20 12V18H4V12H9V14H15V12H20ZM10 12H14V13H10V12Z"></path></svg>
              Lavora con noi
            </div>
            <div>
              <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M18 12H12V16H18V12Z"></path><path d="M2 3V21H22V3H2ZM4 5H7V8L6.5 9H4V5ZM8 5H11.5V8L11 9H8.5L8 8V5ZM12.5 8V5H16V8L15.5 9H13L12.5 8ZM17 5H20V9H17.5L17 8V5ZM20 10V19H10V12H6V19H4V10H7L7.5 9L8 10H11.5L12 9L12.5 10H16L16.5 9L17 10H20Z"></path></svg>
              Deliveboo per le aziende
            </div>
          </div>
        </span>

        <div class="r-none1">
          <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M3 10L5 8.44444V5H9.42857L12 3L21 10V21H3V10ZM14 19H19V10.9782L12 5.53372L5 10.9782V19H10V14H14V19Z"></path></svg>
          Registrati o accedi
        </div>
        <div class="r-none2">
          <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M2 13V11H22V13H2ZM2 19V17H22V19H2ZM2 7V5H22V7H2Z"></path></svg>
          Menu
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
   name: 'Header',
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

//RESPONSIVE
@media screen and (max-width: 1023px) {
  header {
    .my_container{
      .actions{
        .r-none1{
          display:none;
        }
      }
    }
  }

}
@media screen and (max-width: 615px) {
  header {
    .my_container{
      .actions{
        .r-none2{
          display:none;
        }
      }
    }
  }
}

// UTILITIES
.relative{
  position: relative;
}


header{
  position: fixed;
  top: 0;
  z-index: 1;
  width: 100%;
  height: 66px;
  background-color: $d-primary;
  .my_container{
    height: 100%;
    @include flex("space-bet");
    align-items: center;
    .logo{
      text-decoration: none;
      @include flex("center");
      width: 120px;
      cursor: pointer;
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