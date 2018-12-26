<script>
    import {Line} from 'vue-chartjs'
    export default {
        extends: Line,
        data() {
            return {
                rows: [],
                labels: []
            }
        },
        methods: {
            getData() {
                axios.get(`${appurl}/api/userdata`).then( (response) => {
                    this.labels = response.data.data.labels
                    this.rows = response.data.data.rows
                    this.setChart()
                })
            },
            setChart () {
                this.renderChart({
                    labels: this.labels,
                    datasets: [
                        {
                            label: 'Activities',
                            backgroundColor: 'rgba(0, 69, 255, 0.1)',
                            borderWidth: '3',
                            borderColor: '#0045ff',
                            pointRadius: '3',
                            pointBackgroundColor: '#0045ff',
                            pointHoverBackgroundColor: '#6cf',
                            pointHoverBorderColor: '#6cf',
                            data: this.rows
                        }
                    ]
                }, {responsive: true, maintainAspectRatio: false})
            }
        },
        mounted() {
            this.getData()
        }
    }
</script>
