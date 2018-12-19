<template>
    <div class="md-col-6 md-offset-3">
        <div class="panel pane pane--default">
            <div class="panel__header">Register</div>
            <div class="panel__body">
                <form @submit.prevent="submit" method="post">
                    <div class="form__horizontal">
                        <div class="form__group" :class="{ 'has__danger' : errors.name }">
                            <label for="name" class="lg-col-3 lg-text-align-right form__label">Name</label>
                            <div class="lg-col-7">
                                <input type="text" id="name" class="form__item" v-model="form.name">
                                <strong v-if="errors.name" class="form__helper">{{ errors.name[0] }}</strong>
                            </div>
                        </div>
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
                                <button type="submit" class="btn btn--primary-gradient">Register</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>

    import { mapActions } from 'vuex'

    export default {
        name: "Register",
        data() {
            return {
                form: {},
                errors: []
            }
        },
        methods: {
            ...mapActions({
                register: 'auth/register'
            }),
            submit() {
                this.register({
                    payload: {
                        name: this.form.name,
                        email: this.form.email,
                        password: this.form.password
                    },
                    context: this
                }).then(() => {
                    this.$router.replace({ name: 'admin' })
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
