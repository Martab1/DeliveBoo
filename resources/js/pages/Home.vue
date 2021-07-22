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

        <div>Checked: {{checkedTipologies}}</div>
        <div v-for="tipology in tipologies" :key="'tipology'+tipology.id">
            <input
                type="checkbox" 
                :name="tipology"
                :id="tipology.id"
                :value="tipology.id"
                v-model="checkedTipologies"
                 @change="searching()">
            <label :for="tipology.id">{{tipology.name}}</label>
        </div>
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
            tipologies: undefined,
            checkedTipologies: [],
        };
    },

    created() {
        this.getCategories()
    },

    methods: {
        searching() {
            console.log(this.checkedTipologies)
            axios
                .get(`http://127.0.0.1:8000/api/restaurants/filter`,
                {
                    params: {
                        tipology: this.checkedTipologies,
                    }
                })
                .then(res => {
                    console.log(res.data);
                    this.result = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },

        getCategories(){
            axios.get('http://127.0.0.1:8000/api/restaurants')
            .then(res=>{
                this.tipologies = res.data.tipologies;
            })
            .catch(err => {
                console.log(err);
            });
        },
    },
};
</script>

<style></style>
