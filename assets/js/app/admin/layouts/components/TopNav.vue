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
                                <img :src="user.gravatar" class="nav__avatar__img">
                                {{ (user.nickname) ? user.nickname : fullName }}
                            </a>
                            <ul class="nav__links">
                                <router-link class="nav__links__item" tag="li" :to="{name: 'profile'}"><a>Profile</a></router-link>
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
        data() {
            return {
                fullname: '',
                name: '',
                middle: '',
                last: ''
            }
        },
        computed: {
            ...mapGetters({
                user: "auth/user"
            }),
            fullName() {
                this.name = this.user.name ? this.user.name : ''
                this.middle = this.user.middle_name ? this.user.middle_name : ''
                this.last = this.user.lastname ? this.user.lastname : ''

                return  this.name + ' ' + this.middle + ' ' + this.last
            }
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
        },
        mounted(){

        }
    }
</script>

<style scoped>

</style>
