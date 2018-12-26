<script>
    import {Pie} from 'vue-chartjs'
    export default {
        name: "PieChart",
        extends: Pie,
        mounted () {
            this.renderChart({
                labels: ['jan', 'feb', 'mar', 'apr'],
                datasets: [
                    {
                        label: 'my Second chart',
                        backgroundColor: ['#0045ff','#00cdf0', '#f6b00e', '#00f083'],
                        data: ['40', '39', '20', 10]
                    }
                ]
            }, {responsive: true, maintainAspectRatio: false})
        }
    }

</script>
