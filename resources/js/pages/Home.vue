<template>
    <div class="home">
        <div class="container">

            <!-- CHECKBOX CUCINE -->
            <aside>
                <div class="kitchens">
                    <div class="check-container">
                        <div id="label-div" class="w-25" v-for="tipology in tipologies" :key="'tipology'+tipology.id"> 
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

            <div v-if="result.length != 0" class="restaurants">
                <div class="restaurants-container" id="restaurant-div">
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

            <div v-else class="restaurants">
                <h2>
                I nostri suggerimenti
                </h2>
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

body {
    padding: 10px;
    max-height: 100px;
}
.container {
    display: flex;
    flex-direction: column;
    margin-top: 40px;
    color: $special-black2;

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

            div{
                width: calc((100% / 12) - 14px);
                margin: 7px;

                label{
                    display: block;
                    color: $special-black2;
                    transition: 0.3s;
                    box-shadow: 0 1px 3px rgba(0,0,0,.2);
                    width: 100%;
                    background-color: transparent;
                    border-radius: 18px;
                    padding: 2px 0;
                    text-align: center;
                    cursor: pointer;
                    font-size: 14px;

                    &:hover{
                        background-color: $special-white;
                        box-shadow: 0 2px 5px rgba(0,0,0,.2);
                    }

                    input{
                        display: none;
                    }
                }
            }

            .checked{
                background-color: #f0883df6;
                color: white;
                box-shadow: 0 2px 5px rgba(0,0,0,.2);

                &:hover{
                    background-color: #f69b59f6;
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
                width: calc(100% / 5 - 20px);
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
                box-shadow: 0 2px 5px rgba(0,0,0,.8);
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
                    object-fit: cover;
                    height: 100%;
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

@media screen and (max-width:1903px){
    #label-div{
        width: calc((100% / 9) - 14px);
    }

    #restaurant-div > div{
        width: calc((100% / 4) - 20px);
    }
}

@media screen and (max-width:1263px){
    #label-div{
        width: calc((100% / 8) - 14px);
        label{
            font-size: 12px;
        }
    }

    #restaurant-div > div{
        width: calc((100% / 3) - 20px);
    }
}

@media screen and (max-width:833px){
    #label-div{
        width: calc((100% / 7) - 14px);
    }
}

@media screen and (max-width:705px){
    #label-div{
        width: calc((100% / 5) - 14px);
    }
    #restaurant-div > div{
        width: calc((100% / 2) - 20px);
    }
}

@media screen and (max-width:506px){
    #label-div{
        width: calc((100% / 3) - 14px);
    }
    #restaurant-div > div{
        width: calc((100% / 2) - 20px);
    }
}

@media screen and (max-width:506px){
    #label-div{
        width: calc((100% / 3) - 14px);
    }
    #restaurant-div > div{
        width: calc((100% / 1) - 20px);
    }
}

</style>
