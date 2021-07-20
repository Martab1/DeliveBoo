import Vue from "vue";
import VueRouter from "vue-router";
// PAGES
import NotFound from "./pages/NotFound";
import RestaurantShow from "./pages/RestaurantShow";
import Home from "./pages/Home";
import Payment from "./pages/Payment";
import CheckoutSuccess from "./pages/CheckoutSuccess";
import CheckoutError from "./pages/CheckoutError";

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
            path: "/payment",
            component:Payment,
            name:"payment",
        },
        {
            path: "/checkout/success",
            component:CheckoutSuccess,
            name:"checkoutSuccess",
        },
        {
            path: "/checkout/error",
            component:CheckoutError,
            name:"checkoutError",
        },
        {
            path: "*",
            component: NotFound
        }
    ]
});

export default router;
