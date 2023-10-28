<template>
    <div class="steps-label my-5">
        <div class="container-lg">
            <label class="mb-1">{{__('audit.Completed')}}</label>
            <div class="progress" role="progressbar" aria-label="Success striped example" aria-valuenow="25"
                 aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 100%"></div>
                <ul class="list-unstyled p-0 m-0">
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle "></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle"></i></li>
                    <li><i class="fa-solid fa-circle active"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-title text-center py-4">
        <h1>{{__('audit.Audit completed')}}</h1>
    </div>
    <section class="steps py-4 ">

        <div class="container ">
            <form class="buildings border-0">
                <h3 style="text-align: center;padding: 90px 0!important;">
                    {{__('audit.👏 Congratulations! Your application will be reviewed expeditiously')}}

                </h3>

            </form>


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
        this.loading = false
    },
    methods: {
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
