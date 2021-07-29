<template>
    <div class="home">
        <!-- HEADER -->
        <Header/>
        
        <!-- HERO -->
        <section class="hero">
            <div class="my_container">
                <div>
                    <h1>I piatti che ami, a domicilio.</h1>
                </div>
            </div>
        </section>

        <!-- SELECTION -->
        <section class="selection">
            <div class="my_container">
                <h2>La selezione di Deliveboo</h2>
                <div class="row1">
                    <div class="small mr-30">
                        <div class="img img1">Comfort food</div>
                        <div>I grandi classici che scaldano il cuore, perfetti in ogni momento.</div>
                        <a href="">Scopri comfort food</a>
                    </div>
                    <div class="large">
                        <div class="img img2">Dolci e dessert</div>
                        <div>Dolci piaceri per rendere la giornata ancora più gustosa.</div>
                        <a href="">Scopri dolci e dessert</a>
                    </div>
                </div>
                <div class="row2">
                    <div class="large mr-30">
                        <div class="img img3">Perfetti da condividere</div>
                        <div>Serve una scusa per stare insieme?Ordina dai ristoranti che trasformeranno la tua serata in una vera festa.</div>
                        <a href="">Scopri perfetti da condividere</a>
                    </div>
                    <div class="small">
                        <div class="img img4">Esclusiva Deliveboo</div>
                        <div>I più famosi, i più buoni, i preferiti. Quelli che trovi solo su Deliveboo.</div>
                        <a href="">Scopri Esclusiva Deliveboo</a>
                    </div>
                </div>
            </div>

           
            <!-- <aside>
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

            <div v-if="checkedTipologies.length != 0" class="restaurants">
                <div v-if="result.length != 0">
                    <div class="restaurants-container" id="restaurant-div"> -->
                        <!-- PAGE RESULTS -->
                        <!-- <div v-for="restaurant in result" :key="restaurant.id">
                            <router-link class="router-link" :to="{name:'restaurantShow', params:{slug: restaurant.slug}}">
                                <div class="layover">
                                    <h5>{{restaurant.name}}</h5>
                                </div>
                                <img :src="/storage/ + restaurant.image" :alt="restaurant.name">
                            </router-link>
                        </div>
                    </div> -->
                    <!-- PNAV PAG -->
                    <!-- <div class="pagination" v-if="pagination.maxPages != 1">
                        <button
                            @click="searching(pagination.current - 1)"
                            :disabled="pagination.current === 1"
                            :class="{disable : pagination.current === 1}">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button
                            v-for="i in pagination.maxPages"
                            :key="'pag'+i"
                            @click="searching(i)"
                            :class="{active : pagination.current == i}">
                            {{i}}
                        </button>
                        <button
                            @click="searching(pagination.current + 1)"
                            :disabled="pagination.current === pagination.maxPages"
                            :class="{disable : pagination.current === pagination.maxPages}">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div v-else class="no-result">Nessun risultato corrisponde alla ricerca</div>
            </div>

            <div v-else class="restaurants">
                <div class="restaurants-container" id="restaurant-div">
                    <div v-for="restaurant in firstRestaurants" :key="restaurant.id">
                        <router-link class="router-link" :to="{name:'restaurantShow', params:{slug: restaurant.slug}}">
                            <div class="layover">
                                <h5>{{restaurant.name}}</h5>
                            </div>
                            <img :src="/storage/ + restaurant.image" :alt="restaurant.name">
                        </router-link>
                    </div>
                </div> -->

                <!-- PNAV PAG -->
                <!-- <div class="pagination" v-if="pagination.maxPages != 1"> 
                    <button
                        @click="getCategories(pagination.current - 1)"
                        :disabled="pagination.current === 1"
                        :class="{disable : pagination.current === 1}">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <button
                        v-for="i in pagination.maxPages"
                        :key="'pag'+i"
                        @click="getCategories(i)"
                        :class="{active : pagination.current == i}">
                        {{i}}
                    </button>

                    <button
                        @click="getCategories(pagination.current + 1)"
                        :disabled="pagination.current === pagination.maxPages"
                        :class="{disable : pagination.current === pagination.maxPages}">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>-->
        </section>

        <!-- RECOMMENDED -->
        <section class="recommended">
            <div class="my_container">
                <h2>I tuoi piatti preferiti, consegnati da noi</h2>
                 <div class="restaurants-container">
                    <div v-for="restaurant in firstRestaurants" :key="restaurant.id">
                        <router-link class="router-link" :to="{name:'restaurantShow', params:{slug: restaurant.slug}}">
                            <img :src="/storage/ + restaurant.image" :alt="restaurant.name">
                        </router-link>
                        <h5>{{restaurant.name}}</h5>
                    </div>
                </div>
            </div>
        </section>

        <!-- CATEGORIES -->
        <section class="categories">
            <div class="my_container">
                <h2>Cerchi qualcos'altro?</h2>
                <div class="label-div">
                    <!-- TIPOLOGIES -->
                    <div v-for="tipology in tipologies" :key="'tipology'+tipology.id">
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
                <!-- SHOW RESULTS -->
                <div v-if="checkedTipologies.length != 0" class="restaurants">
                    <div class="restaurants-container" id="restaurant-div">
                        <!-- PAGE RESULTS -->
                        <div v-for="restaurant in result" :key="restaurant.id">
                            <router-link class="router-link" :to="{name:'restaurantShow', params:{slug: restaurant.slug}}">
                                <img :src="/storage/ + restaurant.image" :alt="restaurant.name">
                            </router-link>
                            <h5>{{restaurant.name}}</h5>
                        </div>
                    </div>
                    <!-- PNAV PAG -->
                    <div class="pagination" v-if="pagination.maxPages != 1">
                        <button
                            @click="searching(pagination.current - 1)"
                            :disabled="pagination.current === 1"
                            :class="{disable : pagination.current === 1}">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button
                            v-for="i in pagination.maxPages"
                            :key="'pag'+i"
                            @click="searching(i)"
                            :class="{active : pagination.current == i}">
                            {{i}}
                        </button>
                        <button
                            @click="searching(pagination.current + 1)"
                            :disabled="pagination.current === pagination.maxPages"
                            :class="{disable : pagination.current === pagination.maxPages}">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Header from '../components/Header.vue';
export default {
    name: "Home",
    components:{
        Header,
    },
    data() {
        return {
            result: [],
            tipologies: undefined,
            checkedTipologies: [],
            firstRestaurants: [],
            pagination: {},
        };
    },

    created() {
        this.getCategories()
    },

    methods: {
        searching(page = 1) {
            if(!this.checkedTipologies.length == 0){
                axios
                    .get(`http://127.0.0.1:8000/api/restaurants/filter?page=${page}`,
                    {
                        params: {
                            tipology: this.checkedTipologies,
                        }
                    })
                    .then(res => {
                        console.log(res.data);
                        this.result = res.data.data;
                        this.pagination = {
                            current: res.data.current_page,
                            maxPages: res.data.last_page
                        }
                        
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },

        /* dara le categorie e i ristoranti a prima vista */
        getCategories(page = 1){
            axios.get(`http://127.0.0.1:8000/api/restaurants?page=${page}`)
            .then(res=>{
                this.tipologies = res.data.tipologies;
                this.firstRestaurants = res.data.restaurants.data;
                this.pagination = {
                    current: res.data.restaurants.current_page,
                    maxPages: res.data.restaurants.last_page
                }
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
@import '../../sass/mixins.scss';

// UTILITIES
.mr-30{
    margin-right: 30px;
}

// SECTION GENERAL
section{
    padding: 52px 0;
    h2{
        letter-spacing: -.035em;
        font-size: 30px;
        margin-bottom: 40px;
    }
}

// HERO
.hero{
    height: 448px;
    // background-image: url("/img/hero.png");
    background-image: url("https://media-exp1.licdn.com/dms/image/C561BAQHnh3Tsc_uBKQ/company-background_10000/0/1561589281326?e=2159024400&v=beta&t=3cfGYoRfVwt5-vQJL_x4W7MrP_uwZB-PRzqqpfBr5Gg");
    background-size: cover;
    .my_container{
        height: 100%;
        @include flex("center");
        div{
            background-color: rgba(0,0,0,0.15);
            padding: 8px;
            h1{
                text-shadow: 0.5px 0.5px black;
                color: #fff;
                letter-spacing: -.035em;
                font-size: 2.5rem;
            }
        }
    }
}

// SELECTION
.selection{
    .row1, 
    .row2{
        height: 227px;
        @include flex("vertical");
        margin-bottom: 20px;
        .small{
            height: 100%;
            width: 427px;
            cursor: pointer;
            }
        .large{
            height: 100%;
            flex-grow: 1;
            cursor: pointer;
        }
        .img{
            height: 149px;
            margin-bottom: 8px;
            @include flex("center");
            color: #fff;
            text-shadow: 1px 1px black;
            font-size: 40px;
            font-weight: 600;
        }
        .img1{
            background-image: url("https://i2.wp.com/www.eatthis.com/wp-content/uploads/2020/04/unhealthy-foods.jpg?fit=1200%2C879&ssl=1");
            background-size: cover;
            background-position-y: -50px;
        }
        .img2{
            background-image: url("https://st3.idealista.pt/cms/arquivos/styles/idcms_tablet/public/2019-06/media/image/arroz_doce_flickr.jpg?fv=qLaR6DRh&itok=735Gdi3X");
            background-size: cover;
            background-position-y: -150px;
        }
        .img3{
            background-image: url("https://www.giordanovini.it/images/catalogo/social_dinner_3-b.png");
            background-size: cover;
            background-position-y: -100px;
        }
        .img4{
            background-image: url("https://perugia.unicusano.it/wp-content/uploads/2019/04/dipendenza-da-cibo.jpg");
            background-size: cover;
            background-position-y: -80px;
        }
        a{
            color: $d-a;
            text-decoration: none;
            margin: 5px 0 0;
        }
    } 
}

// RECOMMENDED 
.recommended,
.categories{
    background-color: #ffeae4;
    h2{
        margin-bottom: 20px;
    }
        .restaurants-container > div{
                width: calc(100% / 3 - 20px);
                margin: 10px;
            &:hover img{
                transform: scale(1.1);
            }
        }
        .restaurants-container{
            display: flex;
            flex-wrap:  wrap;
            padding:20px;

            .router-link{
                display: block;
                height: 175px;
                width: 100%;
                position: relative;
                border-radius: 5px;
                overflow: hidden;
            }
            h5{
                color: #2e3333;
                font-size: 22px;
                margin: 4px 0 4px;
                text-transform: capitalize;
            }
            img{
                object-fit: cover;
                height: 100%;
                width: 100%;
                transition: 0.3s;
            }
        
        }
}    

// CATEGORIES
.categories{
    background-color: #fff;
    .my_container{
        .label-div{
            @include flex("flex");
            flex-wrap: wrap;
            label{
                font-size: 28px;
                font-weight: bold;
                color: $d-black;
                align-items: center;
                text-transform: capitalize;
                cursor: pointer;
                padding: 5px 10px;
                margin-right: 16px;
            }
            input{
                display: none;
            }
            .checked{
            color: $d-primary;
                &:hover{
                color: #18e2d1;
                }
            }
        }
    }
    .pagination{
    display: flex;
    justify-content: center;
    button{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 35px;
        height: 35px;
        margin: 0 2px;
        background-color: transparent;
        color: $special-black2;
        transition: 0.3s;
        box-shadow: 1px 1px 3px rgba(0,0,0,0.3);

        &:hover{
            background-color: $special-white;
            box-shadow: 0 2px 5px rgba(0,0,0,.2);
        }
    }

    .active{
        background-color: $d-primary;
        color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,.2);

        &:hover{
            background-color: #18e2d1;
        }
    }

    .disable{
        background-color: #cecece;
        box-shadow: inset 0 0 10px rgba(0,0,0,.2);

        &:hover{
           background-color: #cecece;
            box-shadow: inset 0 0 10px rgba(0,0,0,.2); 
        }
    }
}
}

</style>
