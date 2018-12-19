import { AdminDashboard } from "../components"

export default [
    {
        name: 'admin',
        path: '/',
        component: AdminDashboard,
        meta: {
            guest: false,
            needsAuth: true,
            layout: 'app-admin'
        }
    }
]
