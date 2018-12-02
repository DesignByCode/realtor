<template>
    <div class="row">
        <div class="lg-col-7">
            <div class="panel panel--default">
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
            <div class="row">
                <div class="lg-col-12">
                    <google-map-form></google-map-form>
                </div>
            </div>
            <div class="row">
                <div class="lg-col-12">
                    <realtor-property-dropzone></realtor-property-dropzone>
                    <uploaded-images></uploaded-images>
                </div>
            </div>
        </div>
        <div class="md-col-5 sticky-sidebar">
            <google-map></google-map>
        </div>
    </div>
</template>

<script>
    import GoogleMap from '../../admin/GoogleMap'
    import GoogleMapForm from '../../admin/GoogleMapForm'
    import UploadedImages from '../../admin/UploadedImages'

    export default {
        name: "RealtorEditProperty",
        components: {
            GoogleMap,
            GoogleMapForm,
            UploadedImages,
        },
        data() {
            return {
                form: {},
                errors: {},
                updating: false,
                data: {},
                formfile: {},
            }
        },
        methods: {
            updateReference() {
                this.updating = true
                this.$Progress.start()
                axios.patch(`${appurl}/api/properties/${this.$route.params.id}`, this.form).then( (response) => {
                    this.$Progress.finish()
                    this.updating = false
                }).catch( (error) => {
                    this.$Progress.fail()
                    this.updating = false
                })
            },
            getProperty() {
                this.updating = true
                axios.get(`${appurl}/api/properties/${this.$route.params.id}`).then((response) => {
                    this.form = response.data.data
                    this.updating = false
                })
            }
        },
        mounted() {
            this.getProperty()
        }
    }
</script>

<style lang="sass" scoped>
    .edit__group
        display: flex

        button.btn
            flex: 120px
</style>
