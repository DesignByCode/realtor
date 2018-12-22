import VueRouter from 'vue-router';

import auth from './app/admin/auth/routes';
import dashboard from './app/admin/dashboard/routes';
import properties from './app/admin/properties/routes';
import users from './app/admin/users/routes';
import errors from './app/admin/errors/routes';

const routes =  [...auth, ...dashboard, ...properties, ...users, ...errors];



export default new VueRouter ({
    mode: 'hash',
    routes
});
