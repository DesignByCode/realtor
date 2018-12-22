import {Login, Register} from "../components";

export default [
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: {
            guest: true,
            needsAuth: false,
            layout: 'app-auth'
        }

    },
    {
        name: 'register',
        path: '/register',
        component: Register,
        meta: {
            guest: true,
            needsAuth: false,
            layout: 'app-auth'
        }
    },
    {
        name: 'logout',
        path: '/logout',
        component: null,
        meta: {
            guest: false,
            needsAuth: true,
            layout: 'app-auth'
        }
    }

];
