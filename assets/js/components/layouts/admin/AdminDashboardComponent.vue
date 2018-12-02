<template>
    <div>
        <div class="row">
            <div class="lg-col-8">
                <div class="panel panel--default">
                    <div class="panel__header">User Activities Chart</div>
                    <div class="panel__body">
                        <bar-chart></bar-chart>
                    </div>
                </div>
            </div>
            <div class="lg-col-4">
                <clock></clock>
            </div>
        </div>
    </div>
</template>

<script>
    import BarChart from "../../admin/BarChart"
    import Clock from "../../admin/Clock"

    export default {
        components: {
            BarChart,
            Clock
        }
    }
</script>

