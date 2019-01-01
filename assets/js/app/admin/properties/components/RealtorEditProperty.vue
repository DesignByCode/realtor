<template>
    <div class="row">
        <div class="lg-col-7 perspective">
            <property-reference></property-reference>
            <google-autocomplete></google-autocomplete>
            <property-price></property-price>
            <property-features></property-features>
            <!--<property-extras></property-extras>-->
            <property-users></property-users>
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
    import { PropertyExtras, PropertyFeatures,PropertyPrice, PropertyUsers, PropertyReference } from "./PropertyForm";
    import { GoogleMap, GoogleAutocomplete }from './GoogleMap/'
    import RealtorPropertyDropzone from './ImageDropzone/RealtorPropertyDropzone'
    import UploadedImages from './ImageDropzone/UploadedImages'

    export default {
        name: "RealtorEditProperty",
        components: {
            GoogleMap,
            GoogleAutocomplete,
            UploadedImages,
            RealtorPropertyDropzone,
            PropertyPrice,
            PropertyReference,
            PropertyFeatures,
            PropertyExtras,
            PropertyUsers
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


