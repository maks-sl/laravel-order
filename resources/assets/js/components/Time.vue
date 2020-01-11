<template>
    <div>
        <div class="clock">

            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start">
                <img src="images/msk.jpg" class="rounded-circle image" alt="">
                <div class="ml-2">
                    <span class="date">МОСКВА</span>
                    <span class="text">{{ mskWeekDay }}</span>
                    <span class="date">{{ mskDate }}</span>
                </div>
            </div>
            <span class="time">{{ mskTime }}</span>

            <br>
            <br>
            <br>
            <br>
            <br>


            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start">
                <img src="images/hab.jpg" class="rounded-circle image" alt="">
                <div class="ml-2">
                    <span class="date">ХАБАРОВСК</span>
                    <span class="text">{{ habWeekDay }}</span>
                    <span class="date">{{ habDate }}</span>
                </div>
            </div>
            <span class="time">{{ habTime }}</span>

        </div>
    </div>
</template>

<script>

    import moment from 'moment-timezone'

    export default {
        data: () => ({
            mskDate: '',
            mskWeekDay: '',
            mskTime: '',
            habDate: '',
            habWeekDay: '',
            habTime: '',
            week: ['ВОСКРЕСЕНИЕ', 'ПОНЕДЕЛЬНИК', 'ВТОРНИК', 'СРЕДА', 'ЧЕТВЕРГ', 'ПЯТНИЦА', 'СУББОТА'],
        }),
        methods: {
            updData () {
                var msk = moment().tz('Europe/Moscow');
                this.mskDate = msk.format('DD-MM-YYYY');
                this.mskWeekDay = this.week[msk.day()];
                this.mskTime = msk.format('HH:mm:ss');
                var hab = moment().tz('Asia/Vladivostok');
                this.habDate = hab.format('DD-MM-YYYY');
                this.habWeekDay = this.week[hab.day()];
                this.habTime = hab.format('HH:mm:ss');
            },
        },
        created () {
            this.updData();
            this.timer = setInterval(this.updData, 1000)
        },
    }

</script>

<style>
    html,body {
        height: 100%;
    }
    body {
        background: #0f3854;
        background: radial-gradient(ellipse at center,  #0a2e38  0%, #000000 70%);
        background-size: 100%;
    }

    .clock {
        position: absolute;
        text-align: center;
        transform: translate(-50%, -50%);
        font-family: 'Share Tech Mono', monospace;
        color: #daf6ff;
        text-shadow: 0 0 20px rgba(10, 175, 230, 1), 0 0 20px rgba(10, 175, 230, 0);
        left: 50%;
        top: 50%;
        max-width: 320px;
    }

    .image {
        width: 80px;
        height: 80px;
        margin-right: 20px;
    }

    .time {
        letter-spacing: 0.05em;
        font-size: 60px;
    }
    .date {
        letter-spacing: 0.1em;
        font-size: 24px;
    }
    .text {
        letter-spacing: 0.1em;
        font-size: 12px;
        /*padding: 20px 0 0;*/
    }
</style>
