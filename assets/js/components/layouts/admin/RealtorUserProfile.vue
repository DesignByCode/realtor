<template>
    <div class="row">
        <div class="lg-col-3">
            <profile-nav></profile-nav>
        </div>
        <div class="lg-col-9">
            <div class="panel panel--default">
                <div class="panel__header">Header</div>
                <div class="panel__body">
                    <form method="post">
                        <div class="form__group">
                            <label class="form__label font font--bold" for="name">Name</label>
                            <input class="form__item" id="name">
                        </div>
                        <div class="form__group">
                            <label class="form__label font font--bold" for="email">Email</label>
                            <input class="form__item" id="email">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProfileNav from './partials/ProfileNav'
    export default {
        name: "RealtorUserProfile",
        components: {
            ProfileNav
        },
        data() {
          return {

          }
        },
        methods: {
            getProfile() {

            }
        },
        mounted() {
            this.getProfile()
        }
    }
</script>

<style lang="sass" scoped>

</style>
