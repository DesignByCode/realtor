<template>
    <div>
        <div class="main__action">
            <router-link class="btn btn--primary-gradient btn--block" :to="{ name: 'listing-create'}"><i class="lunacon lunacon-open-door"></i> <span>CREATE LISTING</span></router-link>
        </div>
        <ul class="menu">
            <router-link class="memu__item" :to="{ name: 'admin' }" tag="li"><a><i class="lunacon lunacon-dashboard"></i> <span>Dashboard</span></a></router-link>
            <router-link class="memu__item" :to="{ name: 'users' }" tag="li"><a><i class="lunacon lunacon-users-solid"></i> <span>Users</span></a></router-link>
            <router-link class="memu__item" :to="{ name: 'properties-list' }" tag="li"><a><i class="lunacon lunacon-list"></i> <span>Properties</span></a></router-link>
        </ul>

    </div>
</template>

<script>
    export default {
        name: "SidebarMenu"
    }
</script>

<style scoped>

</style>
