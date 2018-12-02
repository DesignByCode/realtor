<template>
    <div class="row">
        <div class="lg-col-8">
            <div class="panel panel--default">
                <div class="panel__header">User Activities Chart</div>
                <div class="panel__body">
                    <bar-chart></bar-chart>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BarChart from "../../admin/BarChart"

    export default {
        components: {
            BarChart
        }
    }
</script>

