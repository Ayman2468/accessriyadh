<template>
    <div class="steps-label my-5">
        <div class="container-lg">
            <label class="mb-1">{{ __('audit.Step') }} 1 {{ __('audit.of') }} 7</label>
            <div class="progress" role="progressbar" aria-label="Success striped example" aria-valuenow="25"
                 aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 14%"></div>
                <ul class="list-unstyled p-0 m-0">
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle active"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-title text-center py-4">
        <h1>{{ __('audit.Building Type Selection') }}</h1>
    </div>
    <section class="steps py-4 loader-container">
        <div class="loader-in-above-div" v-if="loading">
            <div class="loader"></div>
        </div>
        <div class="container ">
            <form class="buildings border-0">
                <label class="mb-2 py-3 h5 d-block text-center min-title">{{ __('audit.Select one building type') }}</label>
                <div class="row">
                    <div v-for="item in items" class="col-lg-3 col-md-6 col-6">
                        <div :class="['input-building h-100',selected_type == item.id ? 'checked' : '']"
                             @click="select_type(item)">
                            <label class="text-center position-relative">
                                <input type="radio" name="building" required>
                                <img class="ratio ratio-1x1" :src="item.image_url">
                                <span>{{ item.name }}</span>
                                <i class="fa-solid fa-circle-check"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-grid gap-2 col-6 mx-auto mt-5 d-flex btns-form">
                <router-link :to="'/audit/building-types/'+selected_type+'/register-info'"
                             style="align-items: center;"
                             :class="['btn','btn-success','d-flex align-content-center justify-content-center','rounded-0','w-100',selected_type == undefined || selected_type == '' ? 'disabled' : '']"
                             type="button">{{ __('audit.Next') }} <i class="fa-solid fa-circle-chevron-right ms-1"></i></router-link>
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
            selected_type: '',
            loading: false,
        }
    },
    async mounted() {
        await this.get_items();
        if(window.sessionStorage.getItem('user')){
            this.get_application_request();
        }
    },
    methods: {
        get_items() {
            this.loading = true;
            axios.get('/landing/audit/building-types').then((response) => {
                this.loading = false;
                this.items = response.data.data;
                console.log(this.items)
            })
        },
        get_application_request() {
            this.loading = true;
            axios.get('/landing/audit/application/').then((response) => {
                this.loading = false;
                this.selected_type = response.data.data.building_type_id;
            })
        },
        select_type(item) {
            this.selected_type = item.id
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

    }
}
</script>
