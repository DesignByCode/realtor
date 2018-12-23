<template>
    <nav class="nav">
        <div class="nav__wrapper--fluid">
            <div class="nav__no__brand"></div>
            <div class="nav__navicon"></div>
            <div class="nav__links__wrapper nav__links--right">
                <ul class="nav__links">
                    <template v-if="user.name">
                        <li class="nav__links__item nav__links__item--dropdown">
                            <a class="nav__avatar" href="#">
                                <img :src="user.gravatar" class="nav__avatar__img">{{ user.name }}</a>
                            <ul class="nav__links">
                                <router-link class="nav__links__item" tag="li" to="profile"><a>Profile</a></router-link>
                                <li class="nav__links__item">
                                    <a href="#" @click="signout">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav__links__item">
                            <router-link to="/register">Register</router-link>
                        </li>
                        <li class="nav__links__item">
                            <router-link to="/login">Login</router-link>
                        </li>
                    </template>

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
        computed: {
            ...mapGetters({
                user: "auth/user"
            })
        },
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
