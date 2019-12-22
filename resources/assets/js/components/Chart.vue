<template>
    <div class="mt-0 mb-0" style="max-width: 800px; margin: auto">
        <bar-chart :chart-data="chartdata" :options="options"></bar-chart>
<!--        <button @click="timerPause()"><span v-if="!timer_paused">Pause</span><span v-if="timer_paused">Play</span></button>-->
    </div>
</template>

<script>

    import BarChart from './BarChart.js'
    import 'chartjs-plugin-datalabels'

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
                responsive: true,
                tooltips: {
                    enabled: false
                },
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        },
                    }]
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: Math.round,
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },
        }),
        props: ['fetchAddress'],
        created () {
            this.updData();
            this.timer = setInterval(this.updData, 1000)
        },

        async mounted () {
            this.loaded = false
            axios.get(this.fetchAddress).then(response => {
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
                    axios.get(this.fetchAddress).then(response => {
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
