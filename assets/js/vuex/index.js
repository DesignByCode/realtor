import Vue from "vue";
import Vuex from "vuex";
import auth from "../app/admin/auth/vuex";
import layouts from "../app/admin/layouts/vuex";
import map from "../app/admin/properties/components/GoogleMap/vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: auth,
        layouts: layouts,
        map: map
    }
});
