import Vue from "vue";
import Vuex from "vuex";
import auth from "../app/admin/auth/vuex";
import layouts from "../app/admin/layouts/vuex";
import properties from "../app/admin/properties/vuex";


Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: auth,
        layouts: layouts,
        properties: properties
    }
});
