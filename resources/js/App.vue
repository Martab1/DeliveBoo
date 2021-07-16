<template>
    <v-app class="app">
        <div>
            <h1>Vue single page application</h1>
            <a href="http://127.0.0.1:8000/admin">ADMIN</a>
            <input
                type="search"
                name="search"
                v-model="search"
                @keyup="searching"
            />

            <div v-for="restaurant in result.restaurants" :key="restaurant.id">
                <div>{{ restaurant.name }}</div>
                <!-- <div>{{ restaurant.address }}</div> -->
            </div>
        </div>
    </v-app>
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
