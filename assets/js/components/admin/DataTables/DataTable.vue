<template>
    <div class="datatable">

        <div v-if="response.allow.creation && creating.active" class="panel panel--default">
            <div class="panel__header">
                Create new record <button  @click.prevent="cancel" class="btn btn--danger">Cancel</button>
            </div>
            <div class="panel__body">
                <div class="well">
                    <form @submit.prevent="store">
                        <div class="form__group" v-for="column in response.updatable" :class="{ 'has__danger' : creating.errors[column] }">

                            <template v-if="response.form_field_type[column] === 'text'">
                                <label :for="column" class="form__label font font--bold">{{ response.custom_columns[column] || column }}</label>
                                <input type="text" class="form__item" :id="column" v-model="creating.form[column]">
                            </template>

                            <template v-if="response.form_field_type[column] === 'number'">
                                <label :for="column" class="form__label font font--bold">{{ response.custom_columns[column] || column }}</label>
                                <input type="number" class="form__item" :id="column" v-model="creating.form[column]">
                            </template>

                            <template v-if="response.form_field_type[column] === 'textarea'">
                                <label :for="column" class="form__label font--bold">{{ response.custom_columns[column] || column }}</label>
                                <textarea :id="column" class="form__item" cols="30" rows="6" v-model="creating.form[column]"></textarea>
                            </template>

                            <template v-if="response.form_field_type[column] === 'checkbox'">
                                <div class="checkbox">
                                    <input type="checkbox" :id="column" :name="column" class="switch-input" :checked="creating.active ? 'checked' : '' "  v-model="creating.form[column]">
                                    <label :for="column" class="switch-label">{{ response.custom_columns[column] || column.toUpperCase() }} <span class="toggle--on">ON</span><span class="toggle--off">OFF</span></label>
                                </div>
                            </template>

                            <template v-if="response.form_field_type[column] === 'date'">
                                <label :for="column" class="form__label font--bold">{{ response.custom_columns[column] || column.toUpperCase() }}</label>
                                <input class="form__item" type="date" :name="column" :id="column" v-model="creating.form[column]">
                            </template>


                            <small class="form__helper" v-if="creating.errors[column]"> {{ creating.errors[column][0] }} </small>
                        </div>
                        <div class="form__group" v-if="response.custom_html.length">
                           <div v-html="response.custom_html"></div>
                        </div>
                        <div class="form__group">
                            <button class="btn btn--primary" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div v-if="!creating.active" class="panel panel--default">
            <div class="panel__header">
                <h3>{{ response.table }}</h3>
                <button v-if="response.allow.creation && !creating.active" @click.prevent="beforeCreating" class="btn btn--primary">Create new</button>

            </div>
            <div class="panel__body">
                <div class="row">
                    <div class="col"><label class="form__label font--bold">Search</label></div>
                </div>
                <form @submit.prevent="getRecords">
                <div class="row">
                    <div class="form__group md-col-6 lg-col-3">
                        <select class="form__item" v-model="search.column">
                            <option :value="column" v-for="column in response.displayable">
                                {{ column }}
                            </option>
                        </select>
                    </div>
                    <div class="form__group md-col-6 lg-col-3">
                        <select class="form__item" v-model="search.operator">
                            <option value="equels">Equels</option>
                            <option value="contains">Contains</option>
                            <option value="starts_with">Starts With</option>
                            <option value="ends_with">Ends With</option>
                            <option value="greater_than">Greater Than</option>
                            <option value="less_than">Less Than</option>
                        </select>
                    </div>
                    <div class="form__group md-col-12 lg-col-6">
                        <div class="form__item__group">
                            <input class="form__item" type="search" id="search" v-model="search.value">
                            <button type="submit" class="btn btn--primary">Search</button>
                        </div>
                    </div>
                </div>
                </form>
                <div class="row">
                    <div class="form__group lg-col-10">
                        <label class="form__label font--bold" for="filter">Quick search current results</label>
                        <input class="form__item" id="filter" type="text" v-model="quickSearchQuery">
                    </div>
                    <div class="form__group lg-col-2">
                        <label class="form__label font--bold" for="limit">Display records</label>
                        <select class="form__item" id="limit" v-model="limit" @change.prevent="getRecords">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                            <option value="">All</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="table__responsive table--border">
            <table class="table table--striped">
                <thead class="table__head">
                <tr>
                    <th v-for="column in response.displayable">
                        <span class="sortable" @click.prevent="sortBy(column)">{{ response.custom_columns[column] || column }}</span>
                        <div
                            class="arrow"
                            v-if="sort.key === column"
                            :class="{ 'arrow--asc' : sort.order === 'asc', 'arrow--desc' : sort.order === 'desc' }"
                        ></div>
                    </th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table__body">
                <tr v-for="record in filteredRecords">
                    <td v-for="columnValue, column in record" :data-title="column">
                        <template v-if="editing.id === record.id && isUpdatable(column)">
                            <div class="ellipsis" :class="{ 'has__danger' : editing.errors[column] }">
                                <input v-if="response.form_field_type[column] === 'text' || response.form_field_type[column] === 'textarea' " class="form__item" type="text" v-model="editing.form[column]">

                                <template v-if="response.form_field_type[column] === 'checkbox'">
                                    <div class="checkbox">
                                        <input type="checkbox" :id="column" :name="column" class="switch-input" :checked="editing.active ? 'checked' : '' "  v-model="editing.form[column]">
                                        <label :for="column" class="switch-label">{{ response.custom_columns[column] || column }} <span class="toggle--on">ON</span><span class="toggle--off">OFF</span></label>
                                    </div>
                                </template>

                                <template v-if="response.form_field_type[column] === 'number'">
                                    <input class="form__item" type="number" :name="column" :id="column" v-model="editing.form[column]">
                                </template>

                                <template v-if="response.form_field_type[column] === 'date'">
                                    <input class="form__item" type="date" :name="column" :id="column" v-model="editing.form[column]">
                                </template>

                                <small class="form__helper" v-if="editing.errors[column]"> {{ editing.errors[column][0] }}
                                </small>
                            </div>
                        </template>
                        <template v-else>
                            <div class="ellipsis">
                                {{ columnValue }}
                            </div>
                        </template>
                    </td>
                    <td class="table--action">
                        <template v-if="editing.id !== record.id">
                            <button  @click.prevent="edit(record)" class="btn btn--sm btn--primary" type="button">Edit</button>
                            <button v-if="response.allow.deletion" @click.prevent="destroy(record.id)" class="btn btn--sm btn--danger" type="button">Delete</button>
                        </template>
                        <template v-if="editing.id === record.id">
                            <button @click.prevent="update" class="btn btn--sm btn--success">Save
                            </button>
                            <button @click.prevent="editing.id = null" class="btn btn--sm btn--warning">
                                Cancel
                            </button>
                        </template>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

    import queryString from 'query-string'

    export default {
        name: "DataTable",
        props: [
            'endpoint'
        ],
        data() {
            return {
                url: `${appurl}/${this.endpoint}`,
                response: {
                    updatable: [],
                    displayable: [],
                    records: [],
                    allow: {}
                },
                sort: {
                    key: 'id',
                    order: 'asc'
                },
                editing: {
                    id: null,
                    form: {},
                    errors: []
                },
                creating: {
                    active: false,
                    form: {},
                    errors: []
                },
                quickSearchQuery: '',
                limit: 50,
                search: {
                    value: '',
                    operator: 'equels',
                    column: 'id'
                }
            }
        },
        computed: {
            filteredRecords() {
                let data = this.response.records

                data = data.filter((row) => {
                    return Object.keys(row).some((key) => {
                        return String(row[key]).toLowerCase().indexOf(this.quickSearchQuery.toLowerCase()) > -1
                    })
                })

                if (this.sort.key) {
                    data = _.orderBy(data, (i) => {
                        let value = i[this.sort.key]
                        if (!isNaN(parseFloat(value))) {
                            return parseFloat(value)
                        }
                        return String(i[this.sort.key]).toLowerCase()
                    }, this.sort.order)
                }
                return data
            }
        },
        methods: {
            getQueryParameters() {
                return queryString.stringify({
                    limit: this.limit,
                    ...this.search
                })
            },
            isUpdatable(column) {
                return this.response.updatable.includes(column)
            },
            getRecords() {
                return axios.get(`${this.url}?${this.getQueryParameters()}`).then((response) => {
                    this.response = response.data.data
                })
            },
            sortBy(column) {
                this.sort.key = column
                this.sort.order = this.sort.order === 'asc' ? 'desc' : 'asc'
            },
            edit(record) {
                this.creating.active = false
                this.editing.errors = []
                this.editing.id = record.id
                this.editing.form = _.pick(record, this.response.updatable)
            },
            beforeCreating() {
                this.creating.active = true
                this.editing.id = null
            },
            update() {
                this.$Progress.start()
                axios.patch(`${this.url}/${this.editing.id}`, this.editing.form).then((response) => {

                    this.getRecords().then(() => {
                        this.$Progress.finish()
                        toastr.success('Successfully Updated')
                        this.editing.id = null
                        this.editing.form = {}
                    })

                }).catch((error) => {
                    this.$Progress.fail()
                    if ( error.response.status === 422) {
                        this.editing.errors = error.response.data.errors
                        toastr.error(error.response.data.message)
                    }
                })
            },
            store() {
                this.$Progress.start()
                axios.post(`${this.url}`, this.creating.form).then( (response) => {
                    this.getRecords().then( () => {
                        this.$Progress.finish()
                        this.creating.active = false
                        this.creating.form = {}
                        this.creating.errors = []
                    })
                }).catch( (error) => {
                    this.$Progress.fail()
                    if (error.response.status === 422) {
                        this.creating.errors = error.response.data.errors
                        toastr.error(error.response.data.message)
                    }
                })
            },
            destroy(record) {
                if (!window.confirm('Are you sure you want to delete this?')) {
                    return
                }
                this.$Progress.start()
                axios.delete(`${this.url}/${record}`).then( () => {
                    this.getRecords()
                    this.$Progress.finish()
                }).catch( (error) => {
                    this.$Progress.fail()
                })
            },
            cancel() {
                this.creating.active = false
                this.creating.form = {}
                this.creating.errors = []
            }
        },
        mounted() {
            this.getRecords()
        }
    }
</script>

<style lang="sass" scoped>


</style>
