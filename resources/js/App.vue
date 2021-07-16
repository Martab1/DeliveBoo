<template>
    <!-- <v-app class="app"> -->
        <div>
        <!-- HEADER -->
        <h1>Vue single page application</h1>
        <a href="http://127.0.0.1:8000/admin">ADMIN</a>
        <input
            style="border: 1px solid black"
            type="text"
            name="search"
            v-model.trim="search"
            @keyup.enter="searching"
        />
        <!-- PAGE RESULTS -->
        <div v-for="restaurant in result.restaurants" :key="restaurant.id">
            <router-link :to="{name:'restaurantShow', params:{slug: restaurant.slug}}"> {{ restaurant.name }} </router-link>
        </div>
        <hr>
        
        <!-- MAIN -->
        <router-view></router-view>

    </div>
    <!-- </v-app> -->
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            search: "",
            result: []
        };
    },
    methods: {
        searching() {
            if (this.search == "") {
                this.result = [];
            }else{
                axios
                    .get(`http://127.0.0.1:8000/api/restaurants`,
                    {
                        params: {
                            tipology:this.search,
                        }
                    })
                    .then(res => {
                        this.result = res.data;
                        console.log(this.result);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        }
    }
};
</script>

<style></style>
