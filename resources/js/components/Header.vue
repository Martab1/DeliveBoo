<template>
   <v-card>
    <v-app-bar
      absolute
      dark
      height="70"
      :bottom='false'
      shrink-on-scroll
      prominent
      src="https://ilfattoalimentare.it/wp-content/uploads/2017/06/junk-food-hamburger-patatine-fast-food-pizza-dolci-Fotolia_130389179_Subscription_Monthly_M.jpg"
      fade-img-on-scroll
      scroll-target="#scrolling-techniques-4"
    >
      <template v-slot:img="{ props }">
        <v-img
          v-bind="props"
          gradient="to top right, rgba(100,115,201,.7), rgba(25,32,72,.7)"
        ></v-img>
      </template>

      <v-toolbar-title id="title">DELIVEBOO</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-menu
        bottom
        left
      >
      </v-menu>

      <template v-slot:extension>
        <v-tabs align-with-title>
          
          <v-tab><router-link class="c-white" :to="{name: 'home'}">home </router-link></v-tab>
          <v-tab><a class="c-white" href="http://127.0.0.1:8000/admin">Area riservata</a></v-tab>
          <!-- <v-tab>Consigliati</v-tab> -->
        </v-tabs>
      </template>
    </v-app-bar>
    <v-sheet
      id="scrolling-techniques-4"
      class="overflow-y-auto"
      max-height="600"
    >
      <v-container style="height: 165px;"></v-container>
    </v-sheet>
  </v-card>
</template>

<script>
export default {
   name: 'Header',
}
</script>

<style scoped lang="scss">
@import '../../sass/vars.scss';
@import '../../sass/mixins.scss';

#title{
  font-weight: 800;
  font-size: 50px;
  color: $special-white;
}
.logo{
  width:100px;
  background:transparent;
}

.center{
  @include flex("center");
}

.c-white{
  padding-top:15px;
  display:block;
  width: 100%;
  height: 100%;
  color: $special-white;
  text-decoration: none;
}

@media screen and (max-width:503px) {
  *{
    font-size: 0.7rem;
  }
  #title{
    font-size: 2.7rem;
  }
}


</style>