<template>
    <div class="center-middle">
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "AppAuth"
    }
</script>
<style lang="sass" scoped>
    .center-middle
        display: flex
        flex-direction: column
        justify-content: center
        height: 100vh

</style>
