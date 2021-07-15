import Vue from "vue";
import VueRouter from "vue-router";
// PAGES
import NotFound from "./pages/NotFound";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "*",
            component: NotFound
        }
    ]
});

export default router;
