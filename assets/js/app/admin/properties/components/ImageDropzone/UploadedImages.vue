<template>
    <div class="preload" :class="{ 'preload--loaded' : loaded }">
        <div v-if="mediagroup.length" class="list">
            <form>
                <div :class="{ 'list--edit' : edit }">
                    <draggable :list="mediagroup" :options="{ 'handle' : '.mover' }" @start="drag=false" @end="drag=false" @change="updateOrder">
                        <images v-for="media, index in mediagroup" :media="media" :index="index" :key="media.id"></images>
                    </draggable>
                </div>
                <div class="panel__footer">
                    <button @click.prevent="editList" v-if="!edit" type="button" class="btn btn--primary-gradient">Edit</button>
                    <button @click.prevent="saveList" v-else type="submit" class="btn btn--primary-gradient">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

    import Images from './Images'
    import draggable from 'vuedraggable'

    export default {
        name: "UploadedImages",
        components: {
          Images,
            draggable
        },
        data() {
            return {
                loaded: false,
                mediagroup: {},
                edit: false
            }
        },
        props: [

        ],
        methods: {
            getAllImages() {
                axios.get(`${appurl}/api/properties/${this.$route.params.id}`).then((response) => {
                    this.mediagroup = response.data.data.media
                    this.loaded = true
                })
            },
            editList() {
                this.edit = true
                bus.$emit('imagelistediting', this.edit)
            },
            updateOrder(event) {
                this.mediagroup.map((media, index) => {
                    media.order_column = index + 1
                  })
            },
            saveList() {
                this.edit = false
                bus.$emit('imagelistediting', this.edit)
                bus.$emit('updateimagelistafterediting')

            }
        },
        mounted() {

            this.getAllImages()

            bus.$on('list_out_images', () => {
                this.getAllImages()
            })

            bus.$on('updateAndRefreshList', (list) => {
                this.mediagroup = list
            })

        }
    }
</script>

<style lang="sass" scoped>

    .list--edit
        padding: 5px
        margin: 5px
        border: dashed 2px #ddd

    .list__item
        transition: all 0.25s ease
        &:hover
            z-index: 3
            box-shadow: rgba(#000, 0.35) 0 2px 10px
            transform: scale(1.01)
            background: white
</style>
