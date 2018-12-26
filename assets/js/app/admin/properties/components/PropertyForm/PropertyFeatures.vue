<template>
    <div class="preload" :class="{ 'preload--loaded' : loaded }">
        <div class="panel panel--default">
            <div class="panel__header">Features</div>
            <div class="panel__body">

                <form @submit.prevent="postFeatures" method="post">
                    <div class="row flex">
                        <div class="col">
                            <div class="well">
                                <h4>Rooms</h4>
                            </div>
                        </div>

                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.bedrooms }">
                            <label for="bedrooms" class="form__label font--bold">Bedrooms</label>
                            <input id="bedrooms" class="form__item" min="0" max="10" type="number" placeholder="Bedrooms" name="bedrooms" v-model="property.features.bedrooms">
                            <span v-if="errors.bedrooms" class="form__helper">{{ errors.bedrooms[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.bathrooms }">
                            <label for="bathrooms" class="form__label font--bold">Bathrooms</label>
                            <input id="bathrooms" class="form__item" min="0" max="10" type="number" placeholder="Bathrooms" name="bathrooms" v-model="property.features.bathrooms">
                            <span v-if="errors.bathrooms" class="form__helper">{{ errors.bathrooms[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.dining_areas }">
                            <label for="dining_areas" class="form__label font--bold">Dining Areas</label>
                            <input id="dining_areas" class="form__item" min="0" max="10" type="number" placeholder="Dining Areas" name="dining_areas" v-model="property.features.dining_areas">
                            <span v-if="errors.dining_areas" class="form__helper">{{ errors.dining_areas[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.en_suites }">
                            <label for="en_suites" class="form__label font--bold">En-Suites</label>
                            <input id="en_suites" class="form__item" min="0" max="10" type="number" placeholder="En-Suites" name="en_suites" v-model="property.features.en_suites">
                            <span v-if="errors.en_suites" class="form__helper">{{ errors.en_suites[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.lounges }">
                            <label for="lounges" class="form__label font--bold">Lounges</label>
                            <input id="lounges" class="form__item" min="0" max="10" type="number" placeholder="Lounges" name="lounges" v-model="property.features.lounges">
                            <span v-if="errors.lounges" class="form__helper">{{ errors.lounges[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.storeys }">
                            <label for="storeys" class="form__label font--bold">Storeys</label>
                            <input id="storeys" class="form__item" min="0" max="10" type="number" placeholder="Storeys" name="storeys" v-model="property.features.storeys">
                            <span v-if="errors.storeys" class="form__helper">{{ errors.storeys[0] }}</span>
                        </div>

                        <div class="col">
                            <div class="well">
                                <h4>Property Size</h4>
                            </div>
                        </div>

                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.floor_area }">
                            <label for="floor_area" class="form__label font--bold">Floor Area</label>
                            <input id="floor_area" class="form__item" min="0"  type="number" placeholder="Floor Area" name="floor_area" v-model="property.features.floor_area">
                            <span v-if="errors.floor_area" class="form__helper">{{ errors.floor_area[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.land_area }">
                            <label for="land_area" class="form__label font--bold">Land Area</label>
                            <input id="land_area" class="form__item" min="0" type="number" placeholder="Land Area" name="land_area" v-model="property.features.land_area">
                            <span v-if="errors.land_area" class="form__helper">{{ errors.land_area[0] }}</span>
                        </div>

                        <div class="col">
                            <div class="well">
                                <h4>Parking</h4>
                            </div>
                        </div>

                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.garages }">
                            <label for="garages" class="form__label font--bold">Garages</label>
                            <input id="garages" class="form__item" min="0"  type="number" placeholder="Garages" name="garages" v-model="property.features.garages">
                            <span v-if="errors.garages" class="form__helper">{{ errors.garages[0] }}</span>
                        </div>

                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.covered_parking }">
                            <label for="covered_parking" class="form__label font--bold">Covered Parking</label>
                            <input id="covered_parking" class="form__item" min="0" type="number" placeholder="Covered Parking" name="covered_parking" v-model="property.features.covered_parking">
                            <span v-if="errors.covered_parking" class="form__helper">{{ errors.covered_parking[0] }}</span>
                        </div>

                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.open_parking }">
                            <label for="open_parking" class="form__label font--bold">Open Parking</label>
                            <input id="open_parking" class="form__item" min="0" type="number" placeholder="Open Parking" name="open_parking" v-model="property.features.open_parking">
                            <span v-if="errors.open_parking" class="form__helper">{{ errors.open_parking[0] }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form__group">
                                <button v-if="!updating" type="submit" class="btn btn--primary-gradient">Update</button>
                                <button v-else disabled class="btn">Updating...</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from "vuex"

    export default {
        name: "PropertyFeatures",
        data() {
            return {
                updating: false,
                loaded: true,
                errors: [],
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
            postFeatures() {
                this.errors = []
                this.updating = true
                this.$Progress.start()
                this.update({
                    id: this.$route.params.id,
                    url: "properties/features",
                    form: this.property.features
                }).then( () => {
                    this.$Progress.finish()
                    this.updating = false
                    toastr.success('Features Successfully Updated')
                }).catch( (error) => {
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
    .flex
        display: flex
        align-items: center
        flex-direction: row
</style>
