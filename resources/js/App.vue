<template>
    <v-app class="app">
        <main>
            <router-view></router-view>
        </main>
 
       <Footer/>
       
    </v-app>
</template>

<script>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";

export default {
    name: "App",
    components:{
        Header,
        Footer,
    }
};
</script>

<style>

</style>