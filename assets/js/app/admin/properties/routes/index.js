
import { RealtorCreateProperty, RealtorEditProperty, RealtorPropertiesList } from '../components'

export default [
    {
        name: 'listing-create',
        path: '/listing/create',
        component: RealtorCreateProperty
    },
    {
        name: 'listing-edit',
        path: '/listing/edit/:id',
        component: RealtorEditProperty
    },
    {
        name: 'properties-list',
        path: '/properties/',
        component: RealtorPropertiesList
    }
]
