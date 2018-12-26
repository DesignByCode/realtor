<template>
    <div>
        <div class="row">
            <div class="lg-col-4">
                <profile-details></profile-details>
            </div>
            <div class="lg-col-4">
                <profile-password></profile-password>
            </div>
        </div>
    </div>
</template>

<script>


    import { ProfileDetails } from "./ProfileParts";

    export default {
        name: "RealtorUserProfile",
        component: {
          ProfileDetails
        },
        data() {
            return {

            }
        },
        methods: {
            changePassword() {
                alert('change password')
            }
        }

    }
</script>

<style scoped>

</style>
