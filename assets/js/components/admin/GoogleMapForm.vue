<template>
    <div class="panel panel--default">
        <div class="panel__header">Property full address</div>
        <div class="panel__body">
            <form @submit.prevent="submit" method="post">
                <div class="form__group__v2">
                    <input ref="auto" class="form__tic form__item__v2 not__empty" name="form.full_address" type="text"
                           placeholder="Enter a location" autocomplete="on" v-model="mapAddress">
                    <label class="form__label__v2">Enter a location</label>
                </div>
                <div class="form__group__v2">
                    <button class="btn btn--primary-gradient">Render Map</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GoogleMapForm",
        data() {
            return {
                autocomplete: null,
                mapAddress: '',
                place: null,
                location: {},
                form: {},
                errors: {}
            }
        },
        methods: {
            submit() {

                this.$Progress.start()

                if (this.place !== null) {
                    this.form.full_address = this.place.formatted_address
                    this.form.lat = this.location.lat
                    this.form.lng = this.location.lng
                    this.form.number = this.place.address_components[0].short_name
                    this.form.street_name = this.place.address_components[1].long_name
                    this.form.town = this.place.address_components[2].long_name
                    this.form.city = this.place.address_components[3].long_name
                    this.form.province = this.place.address_components[5].long_name
                    this.form.country = this.place.address_components[6].long_name
                    this.form.post_code = this.place.address_components[7].long_name

                    console.log(this.form)

                }



                axios.patch(`${appurl}/api/properties/${this.$route.params.id}`, this.form).then((response) => {
                    this.$Progress.finish()

                }).catch((error) => {
                    this.$Progress.fail()
                })

                bus.$emit('submit', this.location)

            },
            autoComplete() {
                this.autocomplete = new google.maps.places.Autocomplete(this.$refs.auto);

                this.autocomplete.addListener('place_changed', () => {

                    this.place = this.autocomplete.getPlace();

                    if (!this.place.geometry) {
                        toastr.error("No details available for input: '" + this.place.name + "'");
                        return
                    }

                    this.location.lat = this.place.geometry.location.lat()
                    this.location.lng = this.place.geometry.location.lng()


                })
            },
            getAddress() {
                axios.get(`${appurl}/api/properties/${this.$route.params.id}`).then((response) => {
                    this.mapAddress = response.data.data.full_address
                    this.form.full_address = response.data.data.full_address
                    this.form.lat = parseFloat(response.data.data.lat)
                    this.form.lng = parseFloat(response.data.data.lng)
                    this.location.lat = parseFloat(response.data.data.lat)
                    this.location.lng = parseFloat(response.data.data.lng)
                    bus.$emit('submit', this.location)

                })
            },
        },
        mounted() {
            this.getAddress()
            this.autoComplete()

        }
    }
</script>

