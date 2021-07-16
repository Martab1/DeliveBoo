import Vue from "vue";
import VueRouter from "vue-router";
// PAGES
import NotFound from "./pages/NotFound";
import RestaurantShow from "./pages/RestaurantShow";
import Home from "./pages/Home";

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
            name:"restaurantShow",
        },
        {
            path: "*",
            component: NotFound
        }
    ]
});

export default router;
