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
                    <a href="/">Go home</a>
                </div>
            </div>
        </template>

        <template v-if="!success">
            <div class="form-group">
                <label for="name" class="col-form-label">Name</label>
                <input id="name" class="form-control" name="name" v-model="fields.name"
                       :class="{'is-invalid' : errors && errors.name}">
                <span v-if="errors && errors.name" class="invalid-feedback"><strong>{{ errors.name[0] }}</strong></span>
            </div>

            <div class="form-group">
                <label for="phone" class="col-form-label">Phone</label>
                <input id="phone" type="text" class="form-control" name="phone" v-model="fields.phone"
                       :class="{'is-invalid' : errors && errors.phone}">
                <span v-if="errors && errors.phone" class="invalid-feedback"><strong>{{ errors.phone[0] }}</strong></span>
            </div>

            <div class="form-group">
                <label for="address" class="col-form-label">Address</label>
                <input id="address" type="text" class="form-control" name="address" v-model="fields.address"
                       :class="{'is-invalid' : errors && errors.address}">
                <span v-if="errors && errors.address" class="invalid-feedback"><strong>{{ errors.address[0] }}</strong></span>
            </div>

            <div class="form-group">
                <label for="tariff" class="col-form-label">Tariff</label>
                <select id="tariff" class="form-control" name="tariff" v-model="fields.tariff" @change="changeTariff"
                        :class="{'is-invalid' : errors && errors.tariff}">
                    <option value=""></option>
                    <option v-for="tariff in tariffs" v-bind:value="tariff.id">
                        {{ tariff.name }}
                    </option>
                </select>
                <span v-if="errors && errors.tariff" class="invalid-feedback"><strong>{{ errors.tariff[0] }}</strong></span>
            </div>


            <div class="form-group">
                <label for="date" class="col-form-label">Date</label>
                <select id="date" class="form-control" name="date" v-model="fields.date"
                        :class="{'is-invalid' : errors && errors.date}">
                    <option value=""></option>
                    <option v-for="date in dates" v-bind:value="date.date">
                        {{ date.human }}
                    </option>
                </select>
                <span v-if="errors && errors.date" class="invalid-feedback"><strong>{{ errors.date[0] }}</strong></span>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Checkout</button>
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
                tariffs: [],
                dates: [],
                fields: {},
                errors: {},
                loaded: true,
            }
        },
        methods: {
            init() {
                axios.get('/api/tariffs').then(response => {
                    this.tariffs = response.data.data;
                }).catch(error => {
                    this.fatal = 'Can\'t get tariffs';
                });
            },
            changeTariff() {
                this.fatal = '';
                this.fields.date = null;
                this.dates = [];
                let selected = Number(this.fields.tariff);
                if (selected) {
                    axios.get(`/api/tariffs/${selected}/dates`).then(response => {
                        this.dates = response.data.data;
                    }).catch(error => {
                        this.fatal = 'Can\'t get dates for current tariff';
                    });
                }
            },
            submit() {
                if (this.loaded) {
                    this.fatal = '';
                    this.loaded = false;
                    this.errors = {};
                    axios.post('/api-order/store', this.fields).then(response => {
                        this.fields = {}; //Clear input fields.
                        this.loaded = true;
                        let id = response.data.data.id;
                        this.success = `Order #${id} was received `
                    }).catch(error => {
                        this.loaded = true;
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        } else {
                            this.fatal = 'Order creating error'
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
