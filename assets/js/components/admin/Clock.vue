<template>
    <div class="panel panel--default background--primary">
        <div class="panel__body">
            <p class="time" v-text="currentTime"></p>
        </div>
    </div>
</template>

<script>
    import * as moment from 'moment'
    export default {
        name: "Clock",
        data() {
            return {
                currentTime: null
            }
        },
        methods: {
            updateCurrentTime() {
                this.currentTime = moment().format('LTS');
            }
        },
        created() {
            this.currentTime = moment().format('LTS');
            setInterval(() => {
                this.updateCurrentTime()
            }, 1000)
        }
    }
</script>

<style lang="sass" scoped>

    .time
        padding: 60px 15px
        color: #fff
        font-size: 36px
        text-align: center

</style>
