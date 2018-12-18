<template>
    <div class="row">
        <div class="lg-col-8 lg-offset-2">
            <div class="panel panel--default">
                <div class="panel__header">Create a property</div>
                <div class="panel__body">
                    <blockquote class="blockquote  blockquote--info">
                        <div class="blockquote__header">The reference must be unique</div>
                        <div class="blockquote__body">
                            This is to find the list across plateforms
                        </div>
                    </blockquote>
                    <form @submit.prevent="postForm">
                        <div class="form__group__v2" :class="errors.reference ? 'has__danger' : ''">
                            <input class="form__item__v2 not__empty" type="text" name="reference" placeholder="#reference number" v-model="form.reference">
                            <label class="form__label__v2">Add a property reference number</label>
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

