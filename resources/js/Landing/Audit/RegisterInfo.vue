<template>
    <div class="steps-label my-5">
        <div class="container-lg">
            <label class="mb-1">{{ __('audit.Step') }} 2 {{ __('audit.of') }} 7</label>
            <div class="progress" role="progressbar" aria-label="Success striped example" aria-valuenow="25"
                 aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 28%"></div>
                <ul class="list-unstyled p-0 m-0">
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle active"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <section class="steps step-1 py-5 loader-container">
        <div class="loader-in-above-div" v-if="loading">
            <div class="loader"></div>
        </div>
        <div class="container">
            <form class="buildings">
                <div class="form-block mb-4" id="form_top">
                    <h2 class="title">{{ __('audit.Applicant Information') }}</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('audit.First name') }}</label>
                            <input type="text" v-model="form.first_name" class="form-control">
                            <div v-if="form.errors && form.errors.first_name" class="invalid-feedback">
                                {{ form.errors.first_name[0] }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('audit.Last name') }}</label>
                            <input type="text" class="form-control" v-model="form.last_name">
                            <div v-if="form.errors && form.errors.last_name" class="invalid-feedback">
                                {{ form.errors.last_name[0] }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('audit.Email') }}
                                <!-- <small>{{ __('audit.if your an admin you must insert a different email') }}</small> -->
                            </label>
                            <input type="email" class="form-control" v-model="form.email" @change="validateEmail($event)">
                            <div v-if="msg" class="invalid-feedback">
                                <p v-if="msg['email']">{{ __('validate.Please enter a valid email address') }}</p>
                                <!-- <p v-else-if="form.errors?.email[0]">{{ form.errors.email[0] }}</p> -->
                            </div>
                        </div>
                        <div class="col-md-6" v-show="showPassword">
                            <label class="form-label">{{ __('audit.Password') }}</label>
                            <input type="password" class="form-control" v-model="form.password">
                            <div v-if="form.errors && form.errors.password" class="invalid-feedback">
                                {{ form.errors.password[0] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-block mb-4">
                    <h2 class="title">{{ __('audit.Enter Building Information') }}</h2>
                    <h3 class="form-label">{{ __('audit.Address') }} <i class="req">({{ __('audit.Required') }})</i></h3>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">{{ __('audit.Building or Business Name') }}</label>
                            <input type="text" class="form-control" v-model="form.building_or_business_name">
                            <div v-if="form.errors && form.errors.building_or_business_name" class="invalid-feedback">
                                {{ form.errors.building_or_business_name[0] }}
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">{{ __('audit.Street Address') }}</label>
                            <input type="text" class="form-control" v-model="form.street_address">
                            <div v-if="form.errors && form.errors.street_address" class="invalid-feedback">
                                {{ form.errors.street_address[0] }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('audit.City') }}</label>
                            <input type="text" class="form-control" v-model="form.city">
                            <div v-if="form.errors && form.errors.city" class="invalid-feedback">
                                {{ form.errors.city[0] }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('audit.District') }}</label>
                            <input type="text" class="form-control" v-model="form.district">
                            <div v-if="form.errors && form.errors.district" class="invalid-feedback">
                                {{ form.errors.district[0] }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('audit.ZIP / Postal Code') }}</label>
                            <input type="text" class="form-control" v-model="form.postal_code">
                            <div v-if="form.errors && form.errors.postal_code" class="invalid-feedback">
                                {{ form.errors.postal_code[0] }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('audit.Country') }}</label>
                            <select class="form-select" v-model="form.country_id">
                                <option v-for="country in countries" :value="country.id">{{ country.name_en }}</option>
                            </select>
                            <div v-if="form.errors && form.errors.country_id" class="invalid-feedback">
                                {{ form.errors.country_id[0] }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('audit.Deed Number') }}</label>
                            <input type="text" class="form-control" v-model="form.deed_number">
                            <div v-if="form.errors && form.errors.deed_number" class="invalid-feedback">
                                {{ form.errors.deed_number[0] }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('audit.Plot Number') }}</label>
                            <input type="text" class="form-control" v-model="form.plot_number">
                            <div v-if="form.errors && form.errors.plot_number" class="invalid-feedback">
                                {{ form.errors.plot_number[0] }}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-grid gap-2 col-md-6 mx-auto mt-4 d-flex btns-form">
                <router-link :to="'/audit/building-types'"
                             class="btn btn-secondary w-100 d-flex align-content-center justify-content-center rounded-0"
                             style="align-items: center;" type="button">
                    <i class="fa-solid fa-circle-chevron-left me-1"></i> {{ __('audit.Previous') }}
                </router-link>
                <button @click="register" class="btn btn-success w-100 rounded-0" type="button">{{ __('audit.Next') }} <i
                    class="fa-solid fa-circle-chevron-right"></i></button>
            </div>
        </div>
    </section>

</template>

<script>

export default {
    components: {},
    data() {
        return {
            items: [],
            countries: [],
            form: {
                // first_name: 'mostafa',
                // last_name: 'hilles',
                // email: 'test@test.com',
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                address: '',
                building_or_business_name: '',
                street_address: '',
                country_id: 682,
                city: '',
                district: '',
                postal_code: '',
                deed_number: '',
                plot_number: '',
                phase_id: '1',
                building_type_id: this.$route.params.type,
            },

            selected_type: '',
            loading: false,
            showPassword: true,
            msg:[],
        }
    },
    async mounted() {
        window.scrollTo(0, 0);

        await this.get_items();
        if(window.sessionStorage.getItem('user')){
            this.get_application_request();
        }
    },
    methods: {
        get_items() {
            this.loading = true;
            axios.get('/landing/lists?lists[]=countries').then((response) => {
                this.loading = false;
                this.countries = response.data.data.countries;
                document.getElementById('form_top').scrollIntoView();
            })
        },
        get_application_request() {
            this.loading = true;
            axios.get('/landing/audit/application/').then((response) => {
                this.loading = false;
                this.form = response.data.data;
                console.log(this.form);
                if(this.form.validation){
                    this.showPassword=false;
                    this.form.password=this.form.validation;
                }
            })
        },
        register() {
            this.loading = true;
            this.form.building_type_id = this.$route.params.type;
            axios.post('/landing/audit/register', this.form).then((response) => {
                this.loading = false;
                window.localStorage.setItem('request_id', response.data.data.id)
                this.$router.push({
                    path: '/audit/building-types/' + this.form.building_type_id + '/step/1'
                })
            }).catch((error) => {
                this.loading = false;
                this.form.errors = error.response.data.errors
                if(this.form.errors) document.getElementById('form_top').scrollIntoView();
                if(this.form.errors?.first_name) console.log(this.form?.errors?.first_name[0])
            })
        },
        showError(error) {
            let message_title = error.response.data.message + '\n';
            let message = message_title;
            let errors = error.response.data.errors;
            $.each(errors, function (key, val) {
                $.each(val, function (key2, val2) {
                    message += val2 + '\n'
                });
            });
            this.notify("error", message, 'fas fa-times p-1', 'danger')
        },
        validateEmail(event) {
            if (/^[^@]+@\w+(\.\w+)+\w$/.test(event.target.value)) {
                this.msg['email'] = '';
            } else {
                this.msg['email'] = 'Please enter a valid email address';
            }
        },
    }
}
</script>
