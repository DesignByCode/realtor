import {Login, Register} from "../components";

export default [
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: {
            quest: true,
            needsAuth: false
        }

    },
    {
        name: 'register',
        path: '/register',
        component: Register,
        meta: {
            quest: true,
            needsAuth: false
        }
    }

]
