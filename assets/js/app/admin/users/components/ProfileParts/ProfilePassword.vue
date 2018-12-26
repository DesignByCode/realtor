<template>
    <div>
        <div class="panel panel--default border--danger">
            <div class="panel__header background--danger color--white">Password Change</div>
            <div class="panel__body background--danger-light">
                <form method="post" @submit.prevent="update">
                    <div class="form__group" :class="{ 'has__danger' : errors.password_current }">
                        <label class="form__label font--bold" for="password_current">Current Password</label>
                        <input id="password_current" class="form__item" name="password_current" type="password" v-model="form.password_current">
                        <span class="form__helper" v-if="errors.password_current">
                            {{ errors.password_current[0] }}
                        </span>
                    </div>

                    <div class="form__group" :class="{ 'has__danger' : errors.password }">
                        <label class="form__label font--bold" for="password">Password</label>
                        <input id="password" class="form__item" name="password" type="password" v-model="form.password">
                        <span class="form__helper" v-if="errors.password">
                            {{ errors.password[0] }}
                        </span>
                    </div>

                    <div class="form__group">
                        <label class="form__label font--bold" for="password">Password Confirm</label>
                        <input id="password_confirmation" class="form__item" name="password_confirmation" type="password" v-model="form.password_confirmation">
                    </div>



                    <div class="form__group">
                        <button v-if="!updating" type="submit" class="btn btn--danger-gradient">Change Password</button>
                        <button v-else disabled class="btn">Updating...</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from "vuex"
    export default {
        name: "ProfilePassword",
        data() {
            return {
                form: {},
                updating: false,
                errors: []
            }
        },
        computed: {
            ...mapGetters({
                user: "auth/user"
            })
        },methods: {
            ...mapActions({
                updatePassword: "auth/updateUserProfilePassword"
            }),
            update() {
                this.updating = true
                this.$Progress.start()
                this.updatePassword({
                    form: this.form
                }).then( () => {
                    this.$Progress.finish()
                    this.updating = false
                    this.form = {}
                    toastr.success('Password successfully updated')
                }).catch( (error) => {
                    this.errors = error.response.data.errors
                    this.$Progress.fail()
                    this.updating = false
                    toastr.error(error.response.data.message)
                })
            },
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
