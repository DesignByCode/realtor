<template>
    <div>
        <div class="main__action">
            <router-link class="btn btn--primary-gradient btn--block" :to="{ name: 'listing-create'}"><i class="lunacon lunacon-open-door"></i> <span>CREATE LISTING</span></router-link>
        </div>
        <ul class="menu">
            <router-link class="memu__item" :to="{ name: 'admin' }" tag="li"><a><i class="lunacon lunacon-dashboard"></i> <span>Dashboard</span></a></router-link>
            <router-link class="memu__item" :to="{ name: 'users' }" tag="li"><a><i class="lunacon lunacon-users-solid"></i> <span>Users</span></a></router-link>
            <router-link class="memu__item" :to="{ name: 'properties-list' }" tag="li"><a><i class="lunacon lunacon-list"></i> <span>Properties</span></a></router-link>

            <router-link  class="memu__item" to="/" tag="li"><a><i class="lunacon lunacon-shield-lock-solid"></i> <span>Permissions</span></a></router-link>

        </ul>

    </div>
</template>

<script>

    import { mapGetters } from 'vuex'

    export default {
        name: "SidebarMenu",
        computed: {
            ...mapGetters({
                user: 'auth/user'
            })
        },
        mounted(){

        }
    }
</script>

<style scoped>

</style>
