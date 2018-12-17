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
        <div class="panel panel--default">
            <div class="panel__header">Price</div>
                <div class="panel__body ">
                    <form @submit.prevent="postPrices" method="post">

                        <div class="row">

                            <div class="form__group__v2 lg-col-6" :class="{ 'has__danger' : errors.selling_price }">
                                <input class="form__item__v2 not__empty" type="number" placeholder="Selling price" name="selling_price"  v-model="form.price.selling_price">
                                <label class="form__label__v2">Selling Price</label>
                                <span v-if="errors.selling_price" class="form__helper">{{ errors.selling_price[0] }}</span>
                            </div>

                            <div class="form__group__v2 lg-col-6" :class="{ 'has__danger' : errors.display_price }">
                                <input class="form__item__v2 not__empty" type="number" placeholder="Display price" name="display_price"  v-model="form.price.display_price">
                                <label class="form__label__v2">Display Price</label>
                                <span v-if="errors.display_price" class="form__helper">{{ errors.display_price[0] }}</span>
                            </div>

                            <div class="form__group__v2 lg-col-6" :class="{ 'has__danger' : errors.rates }">
                                <input class="form__item__v2 not__empty" type="number" placeholder="Rates" name="rates"  v-model="form.price.rates">
                                <label class="form__label__v2">Rates</label>
                                <span v-if="errors.rates" class="form__helper">{{ errors.rates[0] }}</span>
                            </div>
                            <div class="form__group__v2 lg-col-6" :class="{ 'has__danger' : errors.levies }">
                                <input class="form__item__v2 not__empty" type="number" placeholder="Levies" name="levies"  v-model="form.price.levies">
                                <label class="form__label__v2">Levies</label>
                                <span v-if="errors.levies" class="form__helper">{{ errors.levies[0] }}</span>
                            </div>


                        </div>
                        <div class="form__group">
                            <button v-if="!updating" type="submit" class="btn btn--primary-gradient">Update</button>
                            <button v-else disabled class="btn">Updating...</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PropertyPrice",
        data() {
            return {
                loaded: false,
                updating: false,
                form: {
                    price: {}
                },
                errors: []
            }
        },
        methods: {
            postPrices() {
                this.updating = true
                this.$Progress.start()
                axios.patch(`${appurl}/api/properties/price/${this.$route.params.id}`, this.form.price).then( (response) => {
                    this.$Progress.finish()
                    this.updating = false
                    this.editReference = false
                    toastr.success('Prices Successfully Updated')
                }).catch( (error) => {
                    this.$Progress.fail()
                    if ( error.response.status === 422) {
                        this.errors = error.response.data.errors
                    }
                    toastr.error(error.response.data.message)
                    this.updating = false
                })
            }
        },
        mounted() {
            bus.$on('property_form_data', (form) => {
                this.form.price = (form.price === null) ? {} : form.price
                this.loaded = true
            })
        }
    }
</script>

<style scoped>

</style>
