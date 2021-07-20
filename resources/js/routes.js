import Vue from "vue";
import VueRouter from "vue-router";
// PAGES
import NotFound from "./pages/NotFound";
import RestaurantShow from "./pages/RestaurantShow";
import Home from "./pages/Home";
import Payment from "./pages/Payment";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path:"/",
            component: Home,
            name:"home",
        },
        {
            path: "/restaurant/:slug",
            component:RestaurantShow,
            props:true,
            name:"restaurantShow",
        },
        {
            path: "/payment",
            component:Payment,
            props:true,
            name:"payment",
        },
        {
            path: "*",
            component: NotFound
        }
    ]
});

export default router;
