
import { RealtorUsers, RealtorUserProfile } from "../components";


export default [
    {
        name: 'users',
        path: '/users',
        component: RealtorUsers,
        meta: {
            guest: false,
            needsAuth: true,
            layout: 'app-admin'
        }
    },
    {
        name: 'profile',
        path: '/user/profile',
        component: RealtorUserProfile,
        meta: {
            guest: false,
            needsAuth: true,
            layout: 'app-admin'
        }
    }
]
