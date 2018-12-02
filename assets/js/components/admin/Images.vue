<template>
    <div class="list__item">
        <a @click.prevent="deleteImage" href="#" class="delete">
            <i class="lunacon lunacon-trash"></i>
        </a>
        <strong>{{med.name}}</strong>

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
