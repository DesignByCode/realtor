<template>
    <div class="list__item">
        <a @click.prevent="deleteImage" href="#" class="delete">
            <i class="lunacon lunacon-trash"></i>
        </a>
        <div class="list__item__details">
            <strong>{{med.name}}</strong>

        </div>

    </div>
</template>

<script>
    export default {
        name: "Images",
        props: [
            'media'
        ],
        data() {
          return {
              med: this.media,
              form: {
                  name: this.media.name
              }
          }
        },
        methods: {
            update() {
                // axios.patch()
            },
            deleteImage() {
                this.$Progress.start()
                axios.delete(`${appurl}/api/property/image/${this.media.id}`).then( (response) => {
                    this.$Progress.finish()
                    toastr.success(`${this.med.name} deleted`)
                    bus.$emit('list_out_images')
                }).catch( (error) => {
                    this.$Progress.fail()
                })
            }
        },
        mounted() {

        }
    }
</script>

<style lang="sass" scoped>

    .list__item
        position: relative

        &__details
            max-width: 85%
            overflow-x: hidden
            white-space: nowrap
            text-overflow: ellipsis

    .delete
        position: absolute
        right: 10px
        top: 10px
        z-index: 2
        border-radius: 3px
        background: darkred
        color: white
        padding: 3px 5px

        &:hover
            color: #e1e1e8


</style>
