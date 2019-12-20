<template>
    <div class="small mt-0 mb-0">
        <bar-chart :chart-data="chartdata" :options="options"></bar-chart>
        <button @click="timerPause()">Pause/Play</button>
    </div>
</template>

<script>

    import BarChart from './BarChart.js'

    export default {
        components: { BarChart },
        data: () => ({
            list: [],
            timer: '',
            timer_paused: false,
            loaded: false,
            chartdata: {
                labels: [],
                datasets: []
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            },
        }),
        created () {
            this.updData();
            this.timer = setInterval(this.updData, 1000)
        },

        async mounted () {
            this.loaded = false
            axios.get('/api/results').then(response => {
                if (response.data) {
                    this.chartdata = response.data;
                    this.loaded = true
                }
            }).catch(error => {
                this.fatal = 'Get results error';
            });
        },
        methods: {
            updData () {
                if (!this.timer_paused) {
                    axios.get('/api/results').then(response => {
                        if (response.data) {
                            this.chartdata = response.data;
                        }
                    }).catch(error => {
                        this.fatal = 'Get results error';
                    });
                }
            },
            timerPause () {
                this.timer_paused = !this.timer_paused;
            },
        }
    }

</script>

<style>
    .small {
        max-width: 600px;
        margin:  150px auto;
    }
</style>
