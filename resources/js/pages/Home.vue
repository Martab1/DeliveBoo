<template>
    <div class="home">
    HOMEEEEEEEEEEEEEEEEEEEEEEE
                <!-- ASIDE -->
        <input
            style="border: 1px solid black"
            type="text"
            name="search"
            v-model.trim="search"
            @keyup="searching"
        />
        <!-- FINE ASIDE -->
        <!-- PAGE RESULTS -->
        <div v-for="restaurant in result.restaurants" :key="restaurant.id">
            <router-link :to="{name:'restaurantShow', params:{slug: restaurant.slug}}"> {{ restaurant.name }} </router-link>
        </div>
        <hr>
    </div>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            search: "",
            result: [],
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
        },
    },
};
</script>

<style></style>
