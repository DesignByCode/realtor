<template>
    <div class="preload" :class="{ 'preload--loaded' : loaded }">
        <div class="panel panel--default">
            <div class="panel__header">Extras</div>
            <div class="panel__body">
<pre><code>
{{ formTags }}

</code></pre>
                <form @submit.prevent="postTags" method="post">
                    <div class="row flex" >

                        <div class="md-col-6 lg-col-4" v-for="tag, index in tags">
                            {{tag}}
                            <div class="checkbox">
                                <input type="checkbox" v-model="formTags" name="form" :id="tag.slug" class="switch-input">
                                <label
                                    :for="tag.slug"
                                    class="switch-label"> {{ tag.name }}
                                    <span class="toggle--on">YES</span><span class="toggle--off">NO</span>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form__group">
                                <button class="btn btn--primary-gradient">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    import {mapActions, mapGetters} from "vuex"

    export default {
        name: "PropertyExtras",
        data() {
            return {
                loaded: true,
                formTags: {}
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
            postTags() {
                this.$Progress.start()

                this.update({
                    id: this.$route.params.id,
                    url: "tags",
                    form: this.form.tags
                }).then((response) => {
                    this.$Progress.finish()
                    toastr.success('Extras Updated Successfully')
                }).catch((error) => {
                    this.$Progress.finish()
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors
                        toastr.error(error.response.data.message)
                        return
                    }
                    toastr.error(error)
                })
            },
            getAllTags() {
                axios.get(`${appurl}/api/tags`).then((response) => {
                    this.tags = response.data.data
                })
            }
        },
        mounted() {
            this.getAllTags()

        }
    }
</script>

<style scoped>

</style>
