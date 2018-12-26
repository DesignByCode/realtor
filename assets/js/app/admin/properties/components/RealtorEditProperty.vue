<template>
    <div class="row">
        <div class="lg-col-7 perspective">
            <property-reference></property-reference>
            <google-autocomplete></google-autocomplete>
            <property-price-vuex></property-price-vuex>
            <property-features></property-features>
            <property-extras></property-extras>
            <realtor-property-dropzone></realtor-property-dropzone>
            <uploaded-images></uploaded-images>
        </div>
        <div class="md-col-5 sticky-sidebar">
            <google-map></google-map>
        </div>
    </div>
</template>
<script>

    import {mapActions, mapGetters} from "vuex"

    import PropertyReference from './PropertyForm/PropertyReference'
    import PropertyPriceVuex from './PropertyForm/PropertyPriceVuex'
    import PropertyFeatures from './PropertyForm/PropertyFeatures'
    import PropertyExtras from './PropertyForm/PropertyExtras'
    import RealtorPropertyDropzone from './ImageDropzone/RealtorPropertyDropzone'
    import GoogleAutocomplete from './GoogleMap/GoogleAutocomplete'
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
            PropertyPriceVuex,
            PropertyFeatures,
            PropertyExtras
        },
        data() {
            return {
                form: {}
            }
        },
        computed: {
            ...mapGetters({
                property: "properties/property"
            })
        },
        methods: {
            ...mapActions({
                fetchProperty: "properties/fetchProperty"
            }),
            getProperty() {
                this.fetchProperty({
                    id: this.$route.params.id
                }).then( () => {
                    bus.$emit('property_form_data', this.form)
                })
            }
        },
        mounted() {
            this.getProperty()


        }
    }
</script>


