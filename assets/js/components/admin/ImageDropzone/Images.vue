<template>
    <div class="list__item">

        <div class="list__item__details">
            <strong v-if="!edit">{{med.name}}</strong>
            <template v-else>
                <a @click.prevent="deleteImage" href="#" class="delete">
                    <i class="lunacon lunacon-trash"></i>
                </a>
                <div>
                    <i class="mover  lunacon lunacon-expand"></i>
                    <input class="form__item" name="name" v-model="med.name">
                </div>
                <input class="form__item" type="hidden" name="order_column" v-model="med.order_column = index">
            </template>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Images",
        props: [
            'media',
            'index'
        ],
        data() {
          return {
              med: this.media,
              edit: false
          }
        },
        methods: {
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
            bus.$on('imagelistediting', (editing) => {
                this.edit = editing
            })

            bus.$on('updateimagelistafterediting', () =>{
                this.$Progress.start()
                axios.patch(`${appurl}/api/media/${this.media.id}`, this.med ).then( (response) => {
                    bus.$emit('list_out_images')
                    this.$Progress.finish()
                }).catch( (error) => {
                    this.$Progress.fail()
                })
            })
        }
    }
</script>

<style lang="sass" scoped>

    .list__item
        position: relative

        &__details
            max-width: 95%
            overflow-x: hidden
            white-space: nowrap
            text-overflow: ellipsis

    .delete
        position: absolute
        right: 10px
        top: 16px
        z-index: 2
        width: 36px
        text-align: center
        height: 36px
        line-height: 30px
        border-radius: 3px
        background: darkred
        color: white
        padding: 3px 5px

        &:hover
            color: #e1e1e8


    .mover
        position: relative
        top: -2px
        width: 36px
        height: 36px
        line-height: 34px
        font-size: 18px
        border: solid 1px #333
        background: linear-gradient(to bottom, #eee, #ddd)
        text-align: center
        color: #333
        border-radius: 3px
        cursor: move


    .form__item
        width: calc(100% - 40px)

</style>
