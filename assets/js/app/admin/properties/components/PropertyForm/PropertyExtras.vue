<template>
    <div class="preload" :class="{ 'preload--loaded' : loaded }">
        <div class="panel panel--default">
            <div class="panel__header">Extras</div>
            <div class="panel__body">
                <form>
                    <template v-for="extra in extras">
                        <div class="row">
                            <div class="col">
                                <div class="well">
                                    <h4>{{ extra.name }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div v-for="item, key in extra.stats" class="md-col-6">
                                <div class="checkbox">
                                    <input type="checkbox" :id="key" :name="key" class="switch-input">
                                    <label :for="key" class="switch-label">{{ item }}
                                        <span class="toggle--on">Yes</span>
                                        <span class="toggle--off">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </template>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PropertyExtras",
        data() {
            return {
                loaded: true,
                extras: {
                    part: {
                        name: "Rooms",
                        stats : {
                            balcony: "Balcony",
                            entrance_hall: "Entrance",
                            tv_room: "Family/TV Room"
                        }
                    },
                    part: {
                        name: "Rooms",
                        stats : {
                            balcony: "Balcony",
                            entrance_hall: "Entrance",
                            tv_room: "Family/TV Room"
                        }
                    },
                }
            }
        },
        methods: {

        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
