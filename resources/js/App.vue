<template>
    <v-app class="app">
        <!-- HEADER -->
        <h1><a href="http://127.0.0.1:8000">Vue single page application</a></h1>
        <a href="http://127.0.0.1:8000/admin">ADMIN</a>
        <!-- FINE HEADER -->

        <!-- MAIN -->
        <main>
            <router-view></router-view>
        </main>

        <!-- FOOTER -->
    </v-app>
</template>

<script>
export default {
    name: "App",
};
</script>

<style>

</style>