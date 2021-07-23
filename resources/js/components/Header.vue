<template>
   <v-card class="overflow-hidden fix">
    <v-app-bar
      absolute
      dark
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

      <!-- <v-app-bar-nav-icon><img  class="logo" src="https://banner2.cleanpng.com/20191013/hbt/transparent-avocado-skys-projectfly5da42116772281.820843401571037462488.jpg" alt=""></v-app-bar-nav-icon> -->

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
      <v-container style="height: 220px;"></v-container>
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

#title{
  font-weight: 800;
  font-size: 50px;
   color:$layout-color;
}
.logo{
  width:100px;
  background:transparent;
}

.c-white{
  color:#fff;
  text-decoration: none;
}




</style>