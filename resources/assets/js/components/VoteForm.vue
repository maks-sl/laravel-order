<template>
    <form @submit.prevent="submit">
        <div v-if="fatal" class="alert alert-danger">
            <strong>{{ fatal }}</strong>
        </div>

        <template v-if="success">
            <div class="alert alert-success">
                <strong>{{ success }}</strong>
            </div>
            <div class="row justify-content-center">
                <div class="col-3">
                    <a href="/">Again?</a>
                </div>
            </div>
        </template>

        <template v-if="!success">

            <div class="form-group">
                <label for="department" class="col-form-label">Department</label>
                <select id="department" class="form-control" name="department" v-model="fields.department" @change="changeDept"
                        :class="{'is-invalid' : errors && errors.department}">
                    <option value=""></option>
                    <option v-for="department in departments" v-bind:value="department.id">
                        {{ department.name }}
                    </option>
                </select>
                <span v-if="errors && errors.department" class="invalid-feedback"><strong>{{ errors.department[0] }}</strong></span>
            </div>

            <div class="form-group">
                <label for="winner" class="col-form-label">Winner</label>
                <select id="winner" class="form-control" name="winner" v-model="fields.winner"
                        :class="{'is-invalid' : errors && errors.winner}">
                    <option value=""></option>
                    <option v-for="winner in winners" v-bind:value="winner.id">
                        {{ winner.name }}
                    </option>
                </select>
                <span v-if="errors && errors.winner" class="invalid-feedback"><strong>{{ errors.winner[0] }}</strong></span>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Vote</button>
            </div>
        </template>
    </form>
</template>


<script>
    export default {
        data() {
            return {
                fatal: '',
                success: '',
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
            changeDept() {
                this.fatal = '';
                this.fields.winner = null;
                this.winners = [];

                let selected = Number(this.fields.department);
                if (selected) {
                    let to_win = [...this.departments];
                    for (let key in to_win) {
                        if (to_win[key].id === selected) {
                            to_win.splice(key, 1);
                        }
                    }
                    this.winners = to_win;
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
                        let id = response.data.data.id;
                        this.success = `Vote #${id} was created`
                    }).catch(error => {
                        this.loaded = true;
                        if (error.response.status === 422) {
                            this.success = `Thanks for you vote!`
                        } else {
                            this.fatal = 'Vote creating error'
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
