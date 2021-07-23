<template>
    <div class="home">
        <div class="container">

            <!-- CHECKBOX CUCINE -->
            <aside>
                <div class="kitchens">
                    <h2>Cucine</h2>
                    <div class="check-container">
                        <div class="w-25" v-for="tipology in tipologies" :key="'tipology'+tipology.id"> 
                            <label :class="{checked : checkedTipologies.includes(tipology.id)}" :for="tipology.id">{{tipology.name}}
                                <input
                                    type="checkbox" 
                                    :name="tipology"
                                    :id="tipology.id"
                                    :value="tipology.id"
                                    v-model="checkedTipologies"
                                    @change="searching()">
                            </label>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="restaurants">
                <h2>Ristoranti</h2>
                <div class="restaurants-container">
                    <!-- PAGE RESULTS -->
                    <div v-for="restaurant in result" :key="restaurant.id">
                        <router-link class="router-link" :to="{name:'restaurantShow', params:{slug: restaurant.slug}}">
                            <div class="layover">
                                <h5>{{restaurant.name}}</h5>
                            </div>
                            <img :src="/storage/ + restaurant.image" :alt="restaurant.name">
                        </router-link>
                    </div>

                </div>
            </div>
        </div>
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
            if(!this.checkedTipologies.length == 0){
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
            }else{
                this.result = [];
            }
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

<style lang="scss" scoped>
@import '../../sass/vars.scss';

/* tablet */
@media screen and (max-width: 878px){
    router-link{
        min-width: calc(100% / 4 - 100px);
        display: block;
    }
    .card{
        width: 100%;
    }
}

body {
    padding: 10px;
    max-height: 100px;
}
.container {
    display: flex;
    flex-direction: column;
    margin-top: 40px;
    color: white;

    aside{
        margin-bottom: 20px;
        h2{
            text-align: center;
            margin-bottom: 20px;
        }

        .kitchens{
            border-radius: 12px;
        }

        .check-container{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
    
            /* Hide scrollbar for IE, Edge and Firefox */
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        
            /* Hide scrollbar for Chrome, Safari and Opera */
            &::-webkit-scrollbar {
                display: none;
            }
        
            div{
                width: calc((100% / 9) - 14px);
                margin: 7px;

                label{
                    display: block;
                    color: grey;
                    transition: 0.3s;
                    width: 100%;
                    background-color: #f5e9e9;
                    border-radius: 18px;
                    padding: 2px 0;
                    text-align: center;
                    cursor: pointer;
                    font-size: 12px;

                    &:hover{
                        background-color: #fafafa;
                        box-shadow: 0px 2px 5px $layout-color;
                    }

                    input{
                        display: none;
                    }
                }
            }

            .checked{
                background-color: $content-color;
                color: white;
                box-shadow: 0px 2px 5px $layout-color;

                &:hover{
                    background-color: #eea1c4;
                }
            }

        }
    }

    .restaurants{
        flex-grow: 1;
        h2{
            margin-bottom: 20px;
            text-align: center;
        }


        .restaurants-container > div{
                width: calc(100% / 4 - 20px);
                margin: 10px;
        }
        .restaurants-container{
            display: flex;
            flex-wrap:  wrap;
            padding:20px;
            border-radius: 12px;


            .router-link{
                display: block;
                height: 150px;
                width: 100%;
                position: relative;
                border-radius: 5px;
                border: 1px solid $layout-color;
                overflow: hidden;

                .layover{
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color:rgba(85, 83, 83, 0.2);
                    transition: 0.4s;
                    z-index: 10;
                    display: flex;
                    align-items: center;
                    justify-content: center;

                    h5{
                        text-decoration: none;
                        color: white;
                        font-size: 20px;
                        text-transform: capitalize;
                    }
                }

                img{
                    width: 100%;
                    transition: 0.3s;
                }

                &:hover img{
                    transform: scale(1.1);
                }
            }
        }    
    }
}
</style>
