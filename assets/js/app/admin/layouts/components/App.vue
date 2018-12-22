<template>
    <div>
        <component v-bind:is="layoutfile"></component>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import AppAdmin from './AppAdmin'
    import AppAuth from './AppAuth'

    export default {
        name: "App",
        data() {
            return {
                layoutfile: "app-auth"
            }
        },
        computed: mapGetters({
            layout: 'layouts/layout'
        }),
        components: {
            AppAdmin,
            AppAuth
        },
        mounted() {
            this.layoutfile = this.$route.meta.layout

        }
    }
</script>
