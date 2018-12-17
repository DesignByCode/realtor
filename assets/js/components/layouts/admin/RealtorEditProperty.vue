<template>
    <div class="row">
        <div class="lg-col-7">
            <property-reference></property-reference>
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
    import PropertyReference from '../../admin/PropertyForm/PropertyReference'
    import RealtorPropertyDropzone from '../../admin/ImageDropzone/RealtorPropertyDropzone'
    import GoogleMap from '../../admin/GoogleMap/GoogleMap'
    import GoogleMapForm from '../../admin/GoogleMap/GoogleMapForm'
    import UploadedImages from '../../admin/ImageDropzone/UploadedImages'

    export default {
        name: "RealtorEditProperty",
        components: {
            GoogleMap,
            GoogleMapForm,
            UploadedImages,
            RealtorPropertyDropzone,
            PropertyReference
        },
        data() {
            return {
                form: {}
            }
        },
        methods: {
            getProperty() {
                axios.get(`${appurl}/api/properties/${this.$route.params.id}`).then((response) => {
                    this.form = response.data.data
                    bus.$emit('property_form_data', this.form)
                })
            }
        },
        mounted() {
            this.getProperty()
        }
    }
</script>

