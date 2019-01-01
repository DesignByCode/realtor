<template>
    <div class="panel panel--default">
        <div class="panel__header">
            <h3>Profile for <strong class="text--primary"> {{user.name}} {{user.middle_name}} {{ user.lastname }}</strong></h3>
            <i v-if="user.nickname"><hr><b>Nickname:</b> <b class="text--secondary">{{ user.nickname }}</b></i>
        </div>
        <div class="panel__body">
            <form method="post" @submit.prevent="update">
                <div class="well">
                    Field with (<span class="text--danger">*</span>) are required
                </div>
                <div class="form__group" :class="{ 'has__danger' : errors.name }">
                    <label for="profile_name" class="form__label font--bold">First Name <span class="text--danger">*</span> </label>
                    <input id="profile_name" class="form__item" name="name" v-model="user.name" placeholder="First name">
                    <span class="form__helper" v-if="errors.name" >
                        {{ errors.name[0] }}
                    </span>
                </div>
                <div class="form__group" :class="{ 'has__danger' : errors.middle_name }">
                    <label for="profile_middle_name" class="form__label font--bold">Middle Name</label>
                    <input id="profile_middle_name" class="form__item" name="middle_name" v-model="user.middle_name" placeholder="Middle name">
                    <span class="form__helper" v-if="errors.middle_name" >
                        {{ errors.middle_name[0] }}
                    </span>
                </div>

                <div class="form__group" :class="{ 'has__danger' : errors.lastname }">
                    <label for="profile_last_name" class="form__label font--bold">Last Name <span class="text--danger">*</span> </label>
                    <input id="profile_last_name" class="form__item" name="lastname" v-model="user.lastname" placeholder="Last name">
                    <span class="form__helper" v-if="errors.lastname" >
                        {{ errors.lastname[0] }}
                    </span>
                </div>

                <blockquote class="blockquote blockquote--info">
                    <div class="blockquote__header ">
                        Nickname
                    </div>
                    <div class="blockquote__body ">
                        If you have a nickname that you are proud to use when fill it in this will override fullname in frontend of website
                    </div>
                </blockquote>

                <transition name="slidefade">
                    <div class="form__group">
                        <label for="profile_nickname" class="form__label font--bold">Nickname</label>
                        <input ref="nickname" id="profile_nickname" class="form__item" name="nickname" v-model="user.nickname" placeholder="Nickname">
                        <span class="form__helper" v-if="errors.nickname" >
                        {{ errors.nickname[0] }}
                    </span>
                    </div>
                </transition>

                <div class="form__group">
                    <button v-if="!updating" type="submit" class="btn btn--primary-gradient">Update Profile Details</button>
                    <button v-else disabled class="btn">Updating...</button>
                </div>
            </form>
        </div>

    </div>
</template>

<script>
    import {mapGetters, mapActions} from "vuex"

    export default {
        name: "ProfileDetails",
        data() {
            return {
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
                updateProfile: "auth/updateUserProfile"
            }),
            update() {
                this.updating = true
                this.$Progress.start()
                this.updateProfile({
                    form: this.user
                }).then( () => {
                    this.$Progress.finish()
                    this.updating = false
                    toastr.success('User details successfully updated')
                }).catch( (error) => {
                    this.errors = error.response.data.errors
                    this.$Progress.fail()
                    this.updating = false
                    toastr.error(error.response.data.message)
                    setTimeout(() => {
                        this.errors = []
                    }, 5000)
                })
            },
        },
        mounted() {

        }
    }
</script>
