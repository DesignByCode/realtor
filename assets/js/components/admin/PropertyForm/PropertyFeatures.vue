<template>
    <div>
        <div class="panel panel--default">
            <div class="panel__header">Features</div>
            <div class="panel__body">
                <form @submit.prevent="postFeatures" method="post">
                    <div class="row">
                        <div class="col">
                            <div class="well">
                                <h4>Rooms</h4>
                            </div>
                        </div>

                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.bedrooms }">
                            <label for="bedrooms" class="form__label font--bold">Bedrooms</label>
                            <input id="bedrooms" class="form__item" min="0" max="10" type="number" placeholder="Bedrooms" name="bedrooms" v-model="form.bedrooms">
                            <span v-if="errors.bedrooms" class="form__helper">{{ errors.bedrooms[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.bathrooms }">
                            <label for="bathrooms" class="form__label font--bold">Bathrooms</label>
                            <input id="bathrooms" class="form__item" min="0" max="10" type="number" placeholder="Bathrooms" name="bathrooms" v-model="form.bathrooms">
                            <span v-if="errors.bathrooms" class="form__helper">{{ errors.bathrooms[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.dining_areas }">
                            <label for="dining_areas" class="form__label font--bold">Dining Areas</label>
                            <input id="dining_areas" class="form__item" min="0" max="10" type="number" placeholder="Dining Areas" name="dining_areas" v-model="form.dining_areas">
                            <span v-if="errors.dining_areas" class="form__helper">{{ errors.dining_areas[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.en_suites }">
                            <label for="en_suites" class="form__label font--bold">En-Suites</label>
                            <input id="en_suites" class="form__item" min="0" max="10" type="number" placeholder="En-Suites" name="en_suites" v-model="form.en_suites">
                            <span v-if="errors.en_suites" class="form__helper">{{ errors.en_suites[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.lounges }">
                            <label for="lounges" class="form__label font--bold">Lounges</label>
                            <input id="lounges" class="form__item" min="0" max="10" type="number" placeholder="Lounges" name="lounges" v-model="form.lounges">
                            <span v-if="errors.lounges" class="form__helper">{{ errors.lounges[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.storeys }">
                            <label for="storeys" class="form__label font--bold">Storeys</label>
                            <input id="storeys" class="form__item" min="0" max="10" type="number" placeholder="Storeys" name="storeys" v-model="form.storeys">
                            <span v-if="errors.storeys" class="form__helper">{{ errors.storeys[0] }}</span>
                        </div>

                        <div class="col">
                            <div class="well">
                                <h4>Property Size</h4>
                            </div>
                        </div>

                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.floor_area }">
                            <label for="floor_area" class="form__label font--bold">Floor Area</label>
                            <input id="floor_area" class="form__item" min="0"  type="number" placeholder="Floor Area" name="floor_area" v-model="form.floor_area">
                            <span v-if="errors.floor_area" class="form__helper">{{ errors.floor_area[0] }}</span>
                        </div>
                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.land_area }">
                            <label for="land_area" class="form__label font--bold">Land Area</label>
                            <input id="land_area" class="form__item" min="0" type="number" placeholder="Land Area" name="land_area" v-model="form.land_area">
                            <span v-if="errors.land_area" class="form__helper">{{ errors.land_area[0] }}</span>
                        </div>

                        <div class="col">
                            <div class="well">
                                <h4>Parking</h4>
                            </div>
                        </div>

                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.garages }">
                            <label for="garages" class="form__label font--bold">Garages</label>
                            <input id="garages" class="form__item" min="0"  type="number" placeholder="Garages" name="garages" v-model="form.garages">
                            <span v-if="errors.garages" class="form__helper">{{ errors.garages[0] }}</span>
                        </div>

                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.covered_parking }">
                            <label for="covered_parking" class="form__label font--bold">Covered Parking</label>
                            <input id="covered_parking" class="form__item" min="0" type="number" placeholder="Covered Parking" name="covered_parking" v-model="form.covered_parking">
                            <span v-if="errors.covered_parking" class="form__helper">{{ errors.covered_parking[0] }}</span>
                        </div>

                        <div class="form__group md-col-4" :class="{ 'has__danger' : errors.open_parking }">
                            <label for="open_parking" class="form__label font--bold">Open Parking</label>
                            <input id="open_parking" class="form__item" min="0" type="number" placeholder="Open Parking" name="open_parking" v-model="form.open_parking">
                            <span v-if="errors.open_parking" class="form__helper">{{ errors.open_parking[0] }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn--primary-gradient">Update</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "PropertyFeatures",
        data() {
            return {
                errors: [],
                form: {
                    bedrooms: 0,
                    bathrooms: 0,
                    dining_areas: 0,
                    en_suites: 0,
                    lounges: 0,
                    storeys: 0,
                    floor_area: 0,
                    land_area: 0,
                    garages: 0,
                    covered_parking: 0,
                    open_parking: 0,
                }
            }
        },
        methods: {
            postFeatures() {
                console.log(this.form)
                this.$Progress.start()
                axios.patch(`${appurl}/api/properties/features/${this.$route.params.id}`, this.form).then( (response) => {
                    this.$Progress.finish()
                    toastr.success('Features Successfully Updated')
                    this.errors = []
                }).catch( (error) => {
                    this.$Progress.fail()
                    if ( error.response.status === 422) {
                        this.errors = error.response.data.errors

                    }
                    toastr.error(error.response.data.message)

                })
            }
        },
        mounted() {
            bus.$on('property_form_data', (form) => {
                this.form = (form.features === null) ? {} : form.features
            })
        }
    }
</script>

<style lang="sass" scoped>
    .flex
        display: flex
        align-items: center
        flex-direction: row
</style>
