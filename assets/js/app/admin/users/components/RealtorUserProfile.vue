<template>
    <div>
        <div class="row">
            <div class="lg-col-6">
                <profile-details></profile-details>
            </div>
            <div class="lg-col-6">
                <profile-gravatar></profile-gravatar>
                <profile-phone></profile-phone>
                <profile-password></profile-password>
            </div>
        </div>
    </div>
</template>

<script>


    import { ProfileDetails, ProfilePassword, ProfilePhone, ProfileGravatar } from "./ProfileParts";

    export default {
        name: "RealtorUserProfile",
        component: {
            ProfileDetails,
            ProfilePassword,
            ProfilePhone,
            ProfileGravatar
        },
        data() {
            return {

            }
        },
        methods: {

        }

    }
</script>

<style scoped>

</style>
