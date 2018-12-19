<template>
    <nav class="nav">
        <div class="nav__wrapper--fluid">
            <div class="nav__no__brand"></div>
            <div class="nav__navicon"></div>
            <div class="nav__links__wrapper nav__links--left">
                <ul class="nav__links">
                    <li class="nav__links__item">
                        <router-link to="/register">Register</router-link>
                    </li>
                    <li class="nav__links__item">
                        <router-link to="/login">Login</router-link>
                    </li>
                    <li class="nav__links__item">
                        <a href="#" @click="signout">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="nav__links__wrapper nav__links--right">
                <ul class="nav__links">
                    <li class="nav__links__item nav__links__item--dropdown">
                        <a class="nav__avatar" href="#">
                            <img src="/img/admin/avatar-mini.jpg" class="nav__avatar__img">Claude</a>
                        <ul class="nav__links">
                            <router-link class="nav__links__item" tag="li" to="profile"><a>Profile</a></router-link>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <div class="nav__shadow"></div>
    </nav>

</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "TopNav",
        computed: mapGetters({
            user: 'auth/user'
        }),
        methods: {
            ...mapActions({
                logout: 'auth/logout'
            }),
            signout() {
                this.logout().then(() => {

                    this.$router.replace({ name: 'login'})
                })
            }
        }
    }
</script>

<style scoped>

</style>
