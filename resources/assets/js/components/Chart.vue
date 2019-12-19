<template>
    <div class="small">
        <line-chart :chart-data="chartdata"></line-chart>
        <button @click="updData()">Update</button>
    </div>
</template>

<script>

    import LineChart from './LineChart.js'

    export default {
        components: { LineChart },
        data: () => ({
            list: [],
            timer: '',
            loaded: false,
            chartdata: {
                labels: ['00:10', '00:20', '00:30', '00:40'],
                datasets: [
                    {
                        label: 'A',
                        backgroundColor: '#f87979',
                        data: [0, 2, 7, 11]
                    },
                    {
                        label: 'B',
                        backgroundColor: '#f87929',
                        data: [1, 7, 8, 9]
                    }
                ]
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
                axios.get('/api/results').then(response => {
                    if (response.data) {
                        this.chartdata = response.data;
                    }
                }).catch(error => {
                    this.fatal = 'Get results error';
                });

                // DATA SAMPLE
                //
                // this.chartdata = {
                //     labels: [this.getRandomInt(), this.getRandomInt()],
                //     datasets: [
                //         {
                //             label: 'Data One',
                //             backgroundColor: '#f87979',
                //             data: [this.getRandomInt(), this.getRandomInt()]
                //         }, {
                //             label: 'Data One',
                //             backgroundColor: '#f87979',
                //             data: [this.getRandomInt(), this.getRandomInt()]
                //         }
                //     ]
                // }
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
