<template>
    <div>
        <data-table endpoint="api/datatables/users"></data-table>
    </div>
</template>

<script>
    import DataTable from '../../components/DataTables/DataTable'
    export default {
        name: "RealtorUsers",
        components: {
            DataTable
        },
        methods: {

        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
