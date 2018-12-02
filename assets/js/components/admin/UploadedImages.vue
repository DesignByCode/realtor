<template>
    <div class="list">
        <images v-for="media in mediagroup" :media="media" :key="media.id"></images>
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
                mediagroup: {}
            }
        },
        props: [

        ],
        methods: {
            getAllImages() {
                axios.get(`${appurl}/api/properties/${this.$route.params.id}`).then((response) => {
                    this.mediagroup = response.data.data.media
                })
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

<style scoped>

</style>
