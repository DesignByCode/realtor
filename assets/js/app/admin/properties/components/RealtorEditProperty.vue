<template>
    <div class="row">
        <div class="lg-col-7 perspective">
            <property-reference></property-reference>
            <google-autocomplete></google-autocomplete>
            <property-price></property-price>
            <property-features></property-features>
            <realtor-property-dropzone></realtor-property-dropzone>
            <uploaded-images></uploaded-images>
        </div>
        <div class="md-col-5 sticky-sidebar">
            <google-map></google-map>
        </div>
    </div>
</template>
<script>
    import PropertyReference from './PropertyForm/PropertyReference'
    import PropertyPrice from './PropertyForm/PropertyPrice'
    import PropertyFeatures from './PropertyForm/PropertyFeatures'
    import GoogleAutocomplete from './GoogleMap/GoogleAutocomplete'
    import RealtorPropertyDropzone from './ImageDropzone/RealtorPropertyDropzone'
    import GoogleMap from './GoogleMap/GoogleMap'
    import UploadedImages from './ImageDropzone/UploadedImages'

    export default {
        name: "RealtorEditProperty",
        components: {
            GoogleMap,
            GoogleAutocomplete,
            UploadedImages,
            RealtorPropertyDropzone,
            PropertyReference,
            PropertyPrice,
            PropertyFeatures
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


