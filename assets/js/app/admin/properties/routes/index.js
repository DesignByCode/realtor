
import { RealtorCreateProperty, RealtorEditProperty, RealtorPropertiesList } from '../components'

export default [
    {
        name: 'listing-create',
        path: '/listing/create',
        component: RealtorCreateProperty,
        meta: {
            guest: false,
            needsAuth: true,
            layout: 'app-admin'
        }
    },
    {
        name: 'listing-edit',
        path: '/listing/edit/:id',
        component: RealtorEditProperty,
        meta: {
            guest: false,
            needsAuth: true,
            layout: 'app-admin'
        }
    },
    {
        name: 'properties-list',
        path: '/properties',
        component: RealtorPropertiesList,
        meta: {
            guest: false,
            needsAuth: true,
            layout: 'app-admin'
        }
    }
]
