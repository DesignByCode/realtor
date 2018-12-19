import Vue from 'vue'
import Vuex from 'vuex'
import auth from '../app/admin/auth/vuex'
import layouts from '../app/admin/layouts/vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth: auth,
        layouts: layouts
    }
})
