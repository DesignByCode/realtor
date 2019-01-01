<template>
    <div>
        <component v-bind:is="appRoute"></component>
        <!--<component v-bind:is="layoutfile"></component>-->
    </div>
</template>

<script>
    import { mapGetters } from "vuex"
    import AppAdmin from './AppAdmin'
    import AppAuth from './AppAuth'

    export default {
        name: "App",
        data() {
            return {
                layoutfile: "app-auth"
            }
        },
        computed: {
            ...mapGetters({
                layout: "layouts/layout"
            }),
            appRoute() {
                return this.layout.view = (this.$route.path === '/login') ? 'app-auth' : 'app-admin'
            }
        },
        components: {
            AppAdmin,
            AppAuth
        },
        mounted() {


        }
    }
</script>
