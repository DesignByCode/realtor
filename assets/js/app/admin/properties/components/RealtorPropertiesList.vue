<template>
    <div>
        <data-table endpoint="api/datatables/properties"></data-table>
    </div>
</template>

<script>
    import { DataTable } from "../../components"

    export default {
        name: "RealtorPropertiesList",
        components: {
            DataTable
        }
    }
</script>

<style scoped>

</style>
