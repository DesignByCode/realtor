<template>
    <div v-if="mediagroup.length" class="list">
        <form>
            <div :class="{ 'list--edit' : edit }">
                <images v-for="media in mediagroup" :media="media" :key="media.id"></images>
            </div>
            <div class="panel__footer">
                <button @click.prevent="editList" v-if="!edit" type="button" class="btn btn--primary-gradient">Edit</button>
                <button @click.prevent="saveList" v-else type="submit" class="btn btn--primary-gradient">Save</button>
            </div>
        </form>
    </div>
</template>

<script>

    import Images from './Images'

    export default {
        name: "UploadedImages",
        components: {
          Images
        },
        data() {
            return {
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
                })
            },
            editList() {
                this.edit = true
                bus.$emit('imagelistediting', this.edit)

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


        }
    }
</script>

<style lang="sass" scoped>

    .list--edit
        padding: 5px
        margin: 5px
        border: dashed 2px #ddd

</style>
