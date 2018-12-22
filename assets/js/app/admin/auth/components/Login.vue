<template>
    <div class="md-col-6 md-offset-3">
        <div class="panel pane pane--default">
            <div class="panel__header">Login</div>
            <div class="panel__body">
                <form @submit.prevent="submit" method="post">
                    <div class="form__horizontal">
                        <div class="form__group" :class="{ 'has__danger' : errors.email }">
                            <label for="email" class="lg-col-3 lg-text-align-right form__label">Email Address</label>
                            <div class="lg-col-7">
                                <input type="text" id="email" class="form__item" v-model="form.email">
                                <strong v-if="errors.email" class="form__helper">{{ errors.email[0] }}</strong>
                            </div>
                        </div>
                        <div class="form__group" :class="{ 'has__danger' : errors.password }">
                            <label for="password" class="lg-col-3 lg-text-align-right form__label">Password</label>
                            <div class="lg-col-7">
                                <input type="password" id="password" class="form__item" v-model="form.password">
                                <strong v-if="errors.password" class="form__helper">{{ errors.password[0] }}</strong>
                            </div>
                        </div>
                        <div class="form__group">
                            <div class="lg-col-7 md-offset-3">
                                <button type="submit" class="btn btn--primary-gradient">Login</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import localforage from 'localforage'
    import { mapActions } from 'vuex'
    // noinspection ES6CheckImport
    import { isEmpty } from 'lodash'

    export default {
        name: "Login",
        data() {
            return {
                form: {},
                errors: []
            }
        },
        methods: {
            ...mapActions({
                login: 'auth/login'
            }),
            submit() {
                this.login({
                    payload: {
                        email: this.form.email,
                        password: this.form.password
                    },
                    context: this
                }).then(() => {
                    localforage.getItem('intended').then( (name) => {
                        if (isEmpty(name)) {
                            this.$router.replace({ name: 'admin' })
                        }
                        this.$router.replace({ name: name })
                    })
                })
            }
        },
        mounted() {

        }
    }
</script>

<style lang="sass" scoped>
    .form__horizontal
        padding-top: 20px

        .form__group
            margin-bottom: 10px


        .form__label
            padding-top: 9px
            font-weight: bolder

</style>
