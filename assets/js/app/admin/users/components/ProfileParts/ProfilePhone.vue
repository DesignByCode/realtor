<template>
    <div class="panel panel--default">
        <div class="panel__header">Contact Numbers</div>
        <div class="panel__body">
                <form @submit.prevent="addButton">
                    <div class="row flex">
                        <div class="form__group lg-col-6" :class="{ 'has__danger' : errors.type }">
                            <select class="form__item" v-model="form.type" name="type">
                                <option value="work" >Work Number</option>
                                <option value="home" >Home Number</option>
                                <option value="cell" >Cell Number</option>
                                <option value="fax" >Fax Number</option>
                            </select>
                            <span class="form__helper" v-if="errors.type">
                            {{ errors.type[0] }}
                        </span>
                        </div>
                        <div class="form__group lg-col-6" :class="{ 'has__danger' : errors.phone }">
                            <input type="text" class="form__item" name="phone" v-model="form.phone" placeholder="Phone Number"/>
                            <span class="form__helper" v-if="errors.phone">
                            {{ errors.phone[0] }}
                        </span>
                        </div>
                        <div class="form__group lg-col-12">
                            <button v-if="!updating" type="submit" class="btn btn--primary-gradient">Add number to list</button>
                            <button v-else disabled class="btn">Updating...</button>
                        </div>
                    </div>
                </form>

            <ul class="list" v-if="user.phones.length">
                <li class="list__item spreed" v-for="num, index in user.phones" :key="num.id" ><span><strong>{{num.type}}::</strong>  {{ num.phone }}</span> <span class="delete" @click.prevent="deleteNumber(num.id)"><i class="lunacon lunacon-close-small"></i></span></li>
            </ul>
        </div>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from "vuex"

    export default {
        name: "ProfilePhone",
        data () {
            return {
                updating: false,
                errors: [],
                form: {
                    type: 'cell',
                    phone: ''
                }
            }
        },
        computed: {
            ...mapGetters({
                user: "auth/user"
            })
        },
        methods: {
            ...mapActions({
                addPhone: "auth/addPhone",
                removePhone: "auth/removePhone",
            }),
            deleteNumber(id){
                this.updating = true
                this.errors = []
                this.$Progress.start()
                this.removePhone({
                    id: id
                }).then( () => {
                    this.$Progress.finish()
                    this.form = {type: 'cell', phone: ''}
                    this.updating = false
                    toastr.success('Removed successfully')
                }).catch( (error) => {
                    this.$Progress.fail()
                    this.updating = false
                    this.errors = error.response.data.errors
                    toastr.error(error.response.data.message)

                })
            },
            addButton() {
                this.updating = true
                this.errors = []
                this.$Progress.start()
                this.addPhone({
                    form: {
                        type: this.form.type,
                        phone: this.form.phone
                    }
                }).then( () => {
                    this.$Progress.finish()
                    this.form = {type: 'cell', phone: ''}
                    this.updating = false
                    toastr.success('Number successfully')
                }).catch( (error) => {
                    this.$Progress.fail()
                    this.updating = false
                    this.errors = error.response.data.errors
                    toastr.error(error.response.data.message)

                    setTimeout(() => {
                        this.errors = []
                    }, 5000)
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

        strong
            text-transform: capitalize
            margin-inside-end: 20px


</style>
