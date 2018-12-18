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

                <div class="checkbox">
                    <input type="checkbox" id="id-name--1" name="set-name" class="switch-input">
                    <label for="id-name--1" class="switch-label">Solemandate <span class="toggle--on">On</span><span class="toggle--off">Off</span></label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="id-name--2" name="set-name" class="switch-input">
                    <label for="id-name--2" class="switch-label">Live <span class="toggle--on">On</span><span class="toggle--off">Off</span></label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="id-name--3" name="set-name" class="switch-input">
                    <label for="id-name--3" class="switch-label">Sold <span class="toggle--on">On</span><span class="toggle--off">Off</span></label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BarChart from "./BarChart"
    import Clock from "./Clock"

    export default {
        name: 'AdminDashboard',
        components: {
            BarChart,
            Clock
        }
    }
</script>
