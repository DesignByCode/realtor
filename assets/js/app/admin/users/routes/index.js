
import { RealtorUsers } from "../components";
import {AdminDashboard} from "../../dashboard/components";

export default [
    {
        name: 'users',
        path: '/users/',
        component: RealtorUsers,
        meta: {
            guest: false,
            needsAuth: true,
            layout: 'app-admin'
        }
    }
]
