<template>
    <div class="row">
        <div class="lg-col-7">
            <property-reference></property-reference>
            <google-map-form></google-map-form>
            <property-price></property-price>
            <realtor-property-dropzone></realtor-property-dropzone>
            <uploaded-images></uploaded-images>
        </div>
        <div class="md-col-5 sticky-sidebar">
            <google-map></google-map>
        </div>
    </div>
</template>
<script>
    import PropertyReference from '../../admin/PropertyForm/PropertyReference'
    import PropertyPrice from '../../admin/PropertyForm/PropertyPrice'
    import GoogleMapForm from '../../admin/GoogleMap/GoogleMapForm'
    import RealtorPropertyDropzone from '../../admin/ImageDropzone/RealtorPropertyDropzone'
    import GoogleMap from '../../admin/GoogleMap/GoogleMap'
    import UploadedImages from '../../admin/ImageDropzone/UploadedImages'

    export default {
        name: "RealtorEditProperty",
        components: {
            GoogleMap,
            GoogleMapForm,
            UploadedImages,
            RealtorPropertyDropzone,
            PropertyReference,
            PropertyPrice
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


