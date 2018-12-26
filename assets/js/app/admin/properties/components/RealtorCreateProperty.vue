<template>
    <div class="row">
        <div class="lg-col-8 lg-offset-2">
            <div class="panel panel--default">
                <div class="panel__header">Create a property listing</div>
                <div class="panel__body">
                    <blockquote class="blockquote  blockquote--warning">
                        <div class="blockquote__header background--warning-light">
                            <h2>The reference must be unique</h2>
                        </div>
                        <div class="blockquote__body">
                            <br>
                            This is to find the list across plateforms
                        </div>
                    </blockquote>
                    <br>
                    <form @submit.prevent="postForm">
                        <div class="form__group" :class="errors.reference ? 'has__danger' : ''">
                            <label for="reference" class="form__label font--bold">Add a property reference number</label>
                            <input id="reference" class="form__item form__item--lg" type="text" name="reference" placeholder="#reference number" autofocus v-model="form.reference">
                            <strong v-if="errors.reference" class="form__helper">
                                {{ errors.reference[0] }}
                            </strong>
                        </div>
                        <div class="form__group__v2">
                            <button v-if="!working" class="btn btn--primary" type="submit">Create Property</button>
                            <template v-else >
                                <button class="btn" disabled type="submit">Create Property</button>
                            </template>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RealtorCreateProperty",

        data() {
            return {
                working: false,
                response: {},
                form: {},
                errors: {}
            }
        },
        methods: {
            postForm() {
                this.working = true
                this.errors = {}
                this.$Progress.start()
                axios.post(`${appurl}/api/properties`, this.form).then( (response) => {
                    this.response = response.data.data
                    this.$Progress.finish()
                    this.working = false
                    this.$router.push({path: `/listing/edit/${this.response.id}`})
                }).catch( (error) => {
                    this.errors = error.response.data.errors
                    this.working = false
                    this.$Progress.fail()
                })


            }
        },
        mounted() {

        }
    }
</script>


