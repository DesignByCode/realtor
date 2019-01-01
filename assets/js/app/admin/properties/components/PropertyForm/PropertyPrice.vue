<template>
    <div class="preload" :class="{ 'preload--loaded' : loaded }">
        <div class="panel panel--default">
            <div class="panel__header">Price</div>
            <div class="panel__body ">

                <form @submit.prevent="postPrices" method="post" novalidate>

                    <div class="row flex">
                        <div class="form__group lg-col-6" :class="{ 'has__danger' : errors.selling_price }">
                            <label for="selling_price" class="form__label font--bold">Selling Price</label>
                            <input class="form__item"
                                   id="selling_price"
                                   type="number" placeholder="Selling price"
                                   min="0"
                                   name="selling_price"
                                   v-model="property.price.selling_price" >
                            <span v-if="errors.selling_price" class="form__helper">{{ errors.selling_price[0] }}</span>
                        </div>

                        <div class="form__group lg-col-6" :class="{ 'has__danger' : errors.display_price }">
                            <label class="form__label font--bold" for="display_price">Display Price</label>
                            <input class="form__item" type="number" placeholder="Display price"
                                   id="display_price"
                                   min="0"
                                   name="display_price" v-model="property.price.display_price">
                            <span v-if="errors.display_price" class="form__helper">{{ errors.display_price[0] }}</span>
                        </div>

                        <div class="form__group lg-col-6" :class="{ 'has__danger' : errors.rates }">
                            <label class="form__label font--bold" for="rates">Rates</label>
                            <input class="form__item" type="number" placeholder="Rates" name="rates"
                                   id="rates"
                                   min="0"
                                   v-model="property.price.rates">
                            <span v-if="errors.rates" class="form__helper">{{ errors.rates[0] }}</span>
                        </div>
                        <div class="form__group lg-col-6" :class="{ 'has__danger' : errors.levies }">
                            <label class="form__label font--bold" for="levies">Levies</label>
                            <input class="form__item" type="number" placeholder="Levies" name="levies"
                                   id="levies"
                                   min="0"
                                   v-model="property.price.levies">
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
</template>

<script>

    import { mapGetters, mapActions } from "vuex"

    export default {
        name: "PropertyPrice",
        data() {
            return {
                loaded: true,
                updating: false,
                errors: [],
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
                update: "properties/updateProperty"
            }),
            postPrices(){
                this.errors = []
                this.updating = true
                this.$Progress.start()
                this.update({
                    id: this.$route.params.id,
                    url: 'properties/price',
                    form: this.property.price
                }).then( () => {
                    this.updating = false
                    this.$Progress.finish()
                    this.editReference = false
                    toastr.success('Prices Successfully Updated')
                }).catch((error) => {
                    this.$Progress.fail()
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors
                    }
                    toastr.error(error.response.data.message)
                    this.updating = false
                })
            }
        }
    }
</script>

