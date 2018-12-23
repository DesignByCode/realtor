<template>
    <div>
        <div class="panel panel--default">
            <div class="panel__header">
                {{ map.name }} have {{ count }} to view
            </div>
            <div class="panel__body">
                <form @submit.prevent="addlink">
                    <div class="form__group">
                        <label class="form__label" for="add_link">Add Link</label>
                        <input id="add_link" class="form__item" v-model="form.link">
                    </div>
                    <div class="form__group">
                        <button class="btn btn--primary">Add link</button>
                    </div>

                </form>
               <ul class="list">
                   <li v-for="link, key in map.links" :key="key" class="list__item">
                       <a :href="link" target="_blank">{{link}}</a>
                   </li>
               </ul>
                <div ref="map" id="map"></div>
            </div>
        </div>

        <div class="panel panel--default">
            <div class="panel__header">Google Panorama</div>
            <div class="panel__body">
                <div ref="pano" id="pano"></div>
            </div>
        </div>

    </div>

</template>

<script>

    import { mapGetters, mapActions } from "vuex"

    export default {
        name: "GoogleMapTest",
        data() {
            return {
                form: {},
                linksCount: 0
            }
        },
        computed: {
            ...mapGetters({
                map: "map/map",
                count: "map/countLinks"
            })
        },
        methods: {
            ...mapActions({
                addLink: "map/addLink"
            }),
            addlink(){
                this.addLink({
                    payload: this.form.link
                }).then(() => {
                    this.form.link = ''
                })
            }
        },
        mounted() {

        }

    }
</script>

<style lang="sass" scoped>

    .panel__body
        display: flex
        flex-direction: column

    #pano,
    #map
        position: relative
        min-height: 300px
        background: #eee
        flex: 1

    .header-button
        float: right

</style>
