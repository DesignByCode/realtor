<template>
    <div>
        <component v-bind:is="layout.view"></component>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import AppAdmin from './AppAdmin'
    import AppAuth from './AppAuth'

    export default {
        name: "App",
        computed: mapGetters({
            layout: 'layouts/layout'
        }),
        components: {
            AppAdmin,
            AppAuth
        }
    }
</script>
