import VueRouter from 'vue-router'


const routes = [
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
        name: 'pagenotfound',
        path: '*',
        component: require('./components/layouts/admin/PageNotFound')
    }


]

export default new VueRouter ({
    mode: 'hash',
    routes
})
