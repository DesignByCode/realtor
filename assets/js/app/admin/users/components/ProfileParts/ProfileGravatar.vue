<template>
    <div class="panel panel--default">
        <div class="panel__body profile__image">
            <img class="profile__gravatar" :src="user.gravatar">
            <div class="profile__gravatar__text">
                <p>Your profile image is hosted on <a href="https://gravatar.com" target="_blank">gravatar.com</a>. This service makes your profile accessible to email application and other services.</p>
                <a href="https://gravatar.com" target="_blank" class="btn btn--primary-gradient">Gravatar</a>
            </div>
        </div>
        <div class="panel__header">Profile Image</div>
    </div>
</template>

<script>

    import { mapGetters } from "vuex"

    export default {
        name: "ProfileGravatar",
        computed: {
            ...mapGetters({
                user: "auth/user"
            })
        }
    }
</script>

<style lang="sass" scoped>

    .panel__header
        border-top: solid 1px darken(#dce1eb, 10%)

</style>
