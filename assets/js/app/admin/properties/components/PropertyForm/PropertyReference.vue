<template>
    <div>
        <div v-if="editReference" class="panel panel--default">
            <div class="panel__header flex--spread">
                <span>Property Listing</span>
                <span>
                    <button @click.prevent="editReference = !editReference" class="btn btn--sm btn--danger">Cancel</button>
                </span>
            </div>
            <div class="panel__body">
                <form @submit.prevent="updateReference" method="post">
                    <div class="form__group" :class="{ 'has__danger' : errors.reference }">
                        <label class="form__label font--bold" for="reference">Reference Number</label>
                        <input class="form__item" id="reference" type="text" placeholder="Reference Number"
                               name="property.reference" v-model="property.reference">
                        <span v-if="errors.reference" class="form__helper">
                            {{ errors.reference[0] }}
                        </span>
                    </div>

                    <div class="form__group">
                        <transition>
                        <button v-if="!updating"
                                type="submit" class="btn btn--primary-gradient">Update</button>
                        <button v-else disabled class="btn">Updating...</button>
                        </transition>
                    </div>
                </form>
            </div>
        </div>
        <div v-else class="panel panel--default  background--primary text--white">
            <div class="panel__header edit__group flex--spread flex--spread--top">
                <div>
                    <small>Reference Nuber</small>
                    <h1># {{property.reference}}</h1>
                </div>
                <div>
                    <button @click.prevent="editReference = !editReference" class="btn btn--sm btn--secondary">Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {mapActions, mapGetters} from "vuex"

    export default {
        name: "PropertyReference",
        component: {

        },
        data() {
            return {
                loaded: false,
                defaultName: null,
                errors: [],
                updating: false,
                data: {},
                formfile: {},
                editReference: false,
            }
        },
        computed: {
            ...mapGetters({
                property: "properties/property"
            })
        },
        methods: {
            ...mapActions({
                update: "properties/updateProperty"
            }),
            updateReference() {
                this.updating = true
                this.$Progress.start()
                this.update({
                    id: this.$route.params.id,
                    url: "properties",
                    form: this.property
                }).then((response) => {
                    this.updating = false
                    this.$Progress.finish()
                    this.editReference = false
                    toastr.success('Reference Number Successfully Updated')
                }).catch((error) => {
                    this.$Progress.fail()
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors
                    }
                    toastr.error(error.response.data.message)
                    this.updating = false
                })
            }
        },
        mounted() {

        }
    }
</script>

<style lang="sass" scoped>



    /*button.btn*/
        /*float: right*/
</style>
