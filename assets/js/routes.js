import VueRouter from 'vue-router'


const routes = [
    {
        name: 'pagenotfound',
        path: '*',
        component: require('./components/layouts/admin/PageNotFound')
    },
    {
        name: 'admin',
        path: '/',
        component: require('./components/layouts/admin/AdminDashboardComponent')
    },
    {
        name: 'listing-create',
        path: '/listing/create',
        component: require('./components/layouts/admin/RealtorCreateProperty')
    },
    {
        name: 'listing-edit',
        path: '/listing/edit/:id',
        component: require('./components/layouts/admin/RealtorEditProperty')
    },
    {
        name: 'properties-list',
        path: '/properties/',
        component: require('./components/layouts/admin/RealtorPropertiesList')
    },
    {
        name: 'users',
        path: '/users/',
        component: require('./components/layouts/admin/RealtorUsers')
    }


]

export default new VueRouter ({
    mode: 'hash',
    routes
})
