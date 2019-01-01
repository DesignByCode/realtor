<template>
    <div class="modal__overlay">
        <div class="modal">
            <div class="modal__header">
                Model Header
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppModal"
    }
</script>

<style lang="sass" scoped>

    .modal
        display: block

        &__overlay
            position: fixed
            top: 0 !important
            left: 0 !important
            right: 0 !important
            width: 100%
            min-height: 100vh

</style>
