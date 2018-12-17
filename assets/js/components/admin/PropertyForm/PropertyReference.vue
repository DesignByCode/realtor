<template>
    <div>
        <div class="the__loader" v-if="!loaded" >
            <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
            </div>
        </div>
        <div v-else>
            <div v-if="editReference" class="panel panel--default">
                <div class="panel__header">
                    Property Listing
                </div>
                <div class="panel__body">
                    <form @submit.prevent="updateReference" method="post">
                        <div class="form__group__v2" :class="{ 'has__danger' : errors.reference }">
                            <input class="form__item__v2 not__empty" type="text" placeholder="Reference Number" name="form.reference"  v-model="form.reference">
                            <label class="form__label__v2">Reference Number</label>
                            <span v-if="errors.reference" class="form__helper">
                                {{ errors.reference[0] }}
                            </span>
                        </div>
                        <div class="form__group">
                            <button v-if="!updating" type="submit" class="btn btn--primary-gradient">Update</button>
                            <button v-else disabled class="btn">Updating...</button>
                        </div>
                    </form>
                </div>
            </div>
            <div v-else class="panel panel--default  background--primary text--white">
                <div class="panel__header edit__group">
                    <div>
                        <small>Reference Nuber</small>
                        <h1># {{form.reference}}</h1>
                    </div>

                    <div><button @click.prevent="editReference = !editReference" class="btn btn--sm btn--secondary">Edit</button></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PropertyReference",
        data() {
            return {
                loaded: false,
                form: {},
                errors: {},
                updating: false,
                data: {},
                formfile: {},
                editReference: false
            }
        },
        methods: {
            updateReference() {
                this.updating = true
                this.$Progress.start()
                axios.patch(`${appurl}/api/properties/${this.$route.params.id}`, this.form).then( (response) => {
                    this.$Progress.finish()
                    this.updating = false
                    this.editReference = false

                }).catch( (error) => {
                    this.$Progress.fail()
                    this.errors = error.response.data.errors
                    this.updating = false
                })
            },
        },
        mounted() {
            bus.$on('property_form_data', (form) => {
                this.form = form
                this.loaded = true
            })
        }
    }
</script>

<style lang="sass" scoped>

    .the__loader
        height: auto
        transform: scale(0.35)

    .edit__group
        display: flex
        justify-content: space-between

        button.btn
            float: right
</style>
