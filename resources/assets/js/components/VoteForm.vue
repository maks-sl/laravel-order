<template>
    <div>

        <div v-if="waiting" class="loader">
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
                            <label for="department" class="col-form-label">Select your Department</label>
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
                            <label for="winner" class="col-form-label">Select Winner</label>
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
                            <button :disabled='submitDisabled' type="submit" class="btn btn-success">Vote</button>
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
                let rememberHash = hash => {
                    this.finger_hash = hash;
                };
                if (window.requestIdleCallback) {
                    requestIdleCallback(function () {
                        Fingerprint2.get(function (components)  {
                            Fingerprint2.get(function (components) {
                                console.log(components) // an array of components: {key: ..., value: ...}
                            });
                            let values = components.map(function (component) { return component.value });
                            let hash = Fingerprint2.x64hash128(values.join(''), 31);
                            rememberHash(hash);
                        });
                    });
                } else {
                    setTimeout(function () {
                        Fingerprint2.get(function (components) {
                            Fingerprint2.get(function (components) {
                                console.log(components) // an array of components: {key: ..., value: ...}
                            });
                            let values = components.map(function (component) { return component.value });
                            let hash =  Fingerprint2.x64hash128(values.join(''), 31);
                            rememberHash(hash);
                        });
                    }, 500)
                }


                axios.get('/api/departments').then(response => {
                    this.departments = response.data.data;
                }).catch(error => {
                    this.fatal = 'Can\'t get departments';
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
                        this.fatal = 'Can\'t get countries';
                    });
                    // let to_win = [...this.departments];
                    // for (let key in to_win) {
                    //     if (to_win[key].id === selected) {
                    //         to_win.splice(key, 1);
                    //     }
                    // }
                    // this.winners = to_win;
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
                    this.fatal = '';
                    this.loaded = false;
                    this.errors = {};
                    axios.post('/vote/store', this.fields).then(response => {
                        this.fields = {}; //Clear input fields.
                        this.loaded = true;
                        // let id = response.data.data.id;
                        // window.location.href = '/';
                        // this.success = `Vote #${id} was created`
                        this.success = `Thanks for you vote!`
                        this.step = null;
                    }).catch(error => {
                        this.loaded = true;
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        } else if (error.response.status === 423) {
                            this.success = `You vote has already been taken. See you soon!`
                            this.step = null;
                        } else {
                            this.fatal = 'Voting error'
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
