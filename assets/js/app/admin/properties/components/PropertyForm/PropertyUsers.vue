<template>
    <div>
        <div class="panel panel--default">
            <div class="panel__header">Assigned Users</div>
            <div class="panel__body">
                <ul class="list">
                    <li class="list__item spreed" :class="{ 'background--primary border--primary text--white font--bold' : user.id === auth.id }" v-for="user in property.users">
                        <span >{{ user.name }} {{ user.lastname }}</span>
                        <span v-if="user.id !== auth.id" class="delete" @click.prevent="remove(user.id)"><i class="lunacon lunacon-close-small"></i></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from "vuex"

    export default {
        name: "PropertyUsers",
        components: {

        },
        data() {
            return {
                userId: null
            }
        },
        computed: {
            ...mapGetters({
                property: "properties/property",
                auth: "auth/user"
            })
        },
        methods: {
            ...mapActions({
                removeUser: "properties/removeUserFromProperty"
            }),
            remove(id) {
                this.$Progress.start()
                this.removeUser({
                    property: this.property.id,
                    user: id
                }).then( () => {
                    this.$Progress.finish()
                    toastr.success('Removed successfully')
                }).catch( (error) => {
                    this.$Progress.fail()
                    this.errors = error.response.data.errors
                    toastr.error(error.response.data.message)
                })
            }

        }

    }
</script>

<style lang="sass" scoped>
    .spreed
        display: flex
        flex-direction: row
        justify-content: space-between
        align-items: center

    .delete
        padding: 5px
        cursor: pointer
        display: block

</style>
