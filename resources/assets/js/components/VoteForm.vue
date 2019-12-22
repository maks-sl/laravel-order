<template>
    <div>

        <div class="card h-min-130" v-if="waiting">
            <div class="card-body">
                <div class="loader">
                    <div class="loader-inner">
                        <div class="loader-line-wrap">
                            <div class="loader-line"></div>
                        </div>
                        <div class="loader-line-wrap">
                            <div class="loader-line"></div>
                        </div>
                        <div class="loader-line-wrap">
                            <div class="loader-line"></div>
                        </div>
                        <div class="loader-line-wrap">
                            <div class="loader-line"></div>
                        </div>
                        <div class="loader-line-wrap">
                            <div class="loader-line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <template v-if="!waiting">

            <form @submit.prevent="submit() + waitTimeLong()">
                <div v-if="success" class="card">
                    <div class="card-body">
                        <div class="alert alert-success">
                            <strong>{{ success }}</strong>
                        </div>
                    </div>
                </div>
                <div v-if="fatal" class="card">
                    <div class="card-body">
                        <div class="alert alert-danger">
                            <strong>{{ fatal }}</strong>
                        </div>
                    </div>
                </div>



                <div v-if="step===0" class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="department" class="col-form-label">Выберите свой офис</label>
                            <select id="department" class="form-control" name="department" v-model="fields.department" @change="changeDept() + waitTime()"
                                    :class="{'is-invalid' : errors && errors.department}">
                                <option value=""></option>
                                <option v-for="department in departments" v-bind:value="department.id">
                                    {{ department.name }}
                                </option>
                            </select>
                            <span v-if="errors && errors.department" class="invalid-feedback"><strong>{{ errors.department[0] }}</strong></span>
                        </div>
                    </div>
                </div>

                <div v-if="step===1" class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="winner" class="col-form-label">За кого голосуем?</label>
                            <select id="winner" class="form-control" name="winner" v-model="fields.winner" @change="changeWinner()"
                                    :class="{'is-invalid' : errors && errors.winner}">
                                <option value=""></option>
                                <option v-for="winner in winners" v-bind:value="winner.id">
                                    {{ winner.name }}
                                </option>
                            </select>
                            <span v-if="errors && errors.winner" class="invalid-feedback"><strong>{{ errors.winner[0] }}</strong></span>
                        </div>

                        <div class="form-group">
                            <button :disabled='submitDisabled' type="submit" class="btn btn-success">Голосовать</button>
                        </div>
                    </div>
                </div>

            </form>

        </template>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                fatal: '',
                success: '',
                step: 0,
                waiting: true,
                submitDisabled: true,
                finger_hash: '',
                platform: '',
                departments: [],
                winners: [],
                fields: {},
                errors: {},
                loaded: true,
            }
        },
        methods: {
            init() {
                this.waitTimeLong();
                let rememberFinger = (hash, platform) => {
                    this.finger_hash = hash;
                    this.platform = platform;
                };
                let initFinger = () => {
                    Fingerprint2.get(function (components)  {
                        let platform = 'Undefined OS';
                        for (let index = 0; index < components.length; ++index) {
                            if (components[index].key === 'platform') {
                                platform = components[index].value;
                                break;
                            }
                        }
                        let values = components.map(function (component) { return component.value });
                        let hash = Fingerprint2.x64hash128(values.join(''), 31);
                        rememberFinger(hash, platform);
                    });
                };
                if (window.requestIdleCallback) {
                    requestIdleCallback(initFinger);
                } else {
                    setTimeout(initFinger, 500)
                }


                axios.get('/api/departments').then(response => {
                    this.departments = response.data.data;
                }).catch(error => {
                    this.fatal = 'Ошибка загрузки офисов';
                });
            },
            unWait() {
                this.waiting = false;
            },
            waitTime () {
                this.waiting = true;
                setTimeout(this.unWait, 1900);
            },
            waitTimeLong () {
                this.waiting = true;
                setTimeout(this.unWait, 3500);
            },
            changeDept() {
                this.fatal = '';
                this.fields.winner = null;
                this.winners = [];

                let selected = Number(this.fields.department);
                if (selected) {
                    axios.get('/api/departments/'+selected+'/countries').then(response => {
                        this.winners = response.data.data;
                        this.step = 1;
                    }).catch(error => {
                        this.fatal = 'Ошибка загрузки стран';
                    });
                }
            },
            changeWinner() {
                this.submitDisabled = true;
                let selected = Number(this.fields.winner);
                if (selected) {
                    this.submitDisabled = false;
                }
            },
            submit() {
                if (this.loaded) {
                    this.fields.finger_hash = this.finger_hash;
                    this.fields.platform = this.platform;
                    this.fatal = '';
                    this.loaded = false;
                    this.errors = {};
                    axios.post('/vote/store', this.fields).then(response => {
                        this.fields = {}; //Clear input fields.
                        this.loaded = true;
                        this.success = 'Спасибо за Ваш голос! С уважением, WORLD VISION by TIHVINSKAYA';
                        this.step = null;
                    }).catch(error => {
                        this.loaded = true;
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        } else if (error.response.status === 423) {
                            this.success = 'Спасибо за Ваш голос! С уважением, WORLD VISION by TIHVINSKAYA.';
                            this.step = null;
                        } else {
                            this.fatal = 'Произошла ошибка. Попробуйте перезагрузить страницу!';
                            this.step = null;
                        }
                    });
                }
            },
        },
        mounted() {
            this.init()
        }
    }

</script>
