/**
  FRONT OFFICE
 **/

window.Vue = require("vue");
window.axios = require("axios");

import App from "./App.vue";
import router from "./routes";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";

Vue.use(Vuetify);

const vuetify = new Vuetify();

const app = new Vue({
    el: "#root",
    vuetify,
    router,
    render: h => h(App)
});
