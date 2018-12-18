import VueRouter from 'vue-router'

import auth from './app/admin/auth/routes'
import dashboard from './app/admin/dashboard/routes'
import properties from './app/admin/properties/routes'
import users from './app/admin/users/routes'
import pageerrors from './app/admin/pageerrors/routes'

const routes =  [...auth, ...dashboard, ...properties, ...users, ...pageerrors]



export default new VueRouter ({
    mode: 'hash',
    routes
})
