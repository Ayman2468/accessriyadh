<template>
    <!-- add-client -->
    <div class="modal fade modal-custom" id="edit-sub-admin" tabindex="-1" aria-labelledby="add-serviceLabel"
         aria-hidden="true"
         data-bs-backdrop="static">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body">
                    <form>

                        <header class="d-flex justify-content-between align-items-start p-4 mb-5 fixed-top bg-white"
                                style="border-bottom: 2px solid #EAECF0;">
                            <a href="#" data-bs-dismiss="modal" @click="close_modal"><img :src="'/images/close.svg'"></a>

                        </header>
                        <footer class="d-flex justify-content-between align-items-start p-4 mt-5 fixed-bottom bg-white"
                                style="border-top: 2px solid rgb(234, 236, 240);background: #f8f8f8 !important;">
                            <a class="btn btn-secondary" href="#" data-bs-dismiss="modal" @click="close_modal">{{ __('general.Cancel') }}</a>
                            <div class="d-flex">
                                <a href="#" @click="update_item"
                                   class="btn btn-primary">{{ __('general.Save changes') }}</a>
                            </div>
                        </footer>

                        <section class="add-service add-staff card-width m-auto pb-4"
                                 style="margin-top: 80px !important;">
                            <div class="container">

                                <div class="form-service form-client mb-4">
                                    <div class="change-avatar-img position-relative">
                                        <input type="file" class="profile-img"
                                               v-on:change="onImageChange">
                                        <img
                                            :src="item.image ? item.image_url : '/images/avatar-profile.svg'"
                                            id="clientPreviewUser">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">رقم الهوية</label>
                                            <input type="text" class="form-control" v-model="item.identity">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">الاسم</label>
                                            <input type="text" class="form-control" v-model="item.name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-mob">
                                                <label class="form-label">{{ __('doctors.Mobile') }}</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control"
                                                           v-model="item.mobile">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">الصلاحية</label>
                                            <select class="form-select"
                                                    v-model="item.role">
                                                <template v-for="role in roles">
                                                    <option :value="role.key">
                                                        {{ role.name }}
                                                    </option>
                                                </template>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4 date">
                                            <label class="form-label">{{
                                                    __('doctors.Email address')
                                                }}</label>
                                            <input type="email" v-model="item.email" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4 date">
                                            <label class="form-label">{{ __('doctors.Password') }}</label>
                                            <input type="password" v-model="item.password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "add-clients",
    components: {},
    data() {
        return {
            item: {
                identity: null,
                name: null,
                mobile_country_code: 966,
                mobile: null,
                email: null,
                password: null,
                role: null,
            },
            roles: [
                {key:'super-admin',name:'مدير'},
                {key:'doctor',name:'طبيب عام'},
                {key:'reception',name:'موظف استقبال'},
                {key:'psychologist',name:'طبيب نفسي'},
                {key:'family',name:'طبيب ارشاد اسري'},
                {key:'religious',name:'طبيب ارشاد ديني'},
            ],

            loading: true,
            search_value: '',
            service_add_btn: 'disabled',
            current_page: null,
        }
    },
    async mounted() {

        this.$root.$on('emit_lists', function (lists) {
            this.countries = lists.countries
            this.referralSources = lists.referralSources
        }.bind(this))

        this.$root.$on('selected_item_for_edit', function (lists) {
            this.item = lists.item;
            this.search_value = lists.search_value
            this.current_page = lists.current_page
            // this.create_item();
        }.bind(this))
    },


    methods: {
        close_modal() {
            this.$root.$emit('refresh-list')
        },
        update_item(e) {
            const config = {headers: {'Content-Type': 'multipart/form-data;', 'e': e}};
            const formData = new FormData();
            formData.append('name', this.item.name);
            formData.append('identity', this.item.identity);
            formData.append('mobile', this.item.mobile);
            formData.append('email', this.item.email);
            formData.append('password', this.item.password);
            formData.append('identity', this.item.identity);
            formData.append('image', this.item.image);
            if (this.item.role)
                formData.append('role', this.item.role);
            axios.post(
                '/vue/admin/user/' + this.item.id + '/update',
                formData, config).then((response) => {

                this.notify('success', 'تم تعديل بيانات المستخدم بنجاح', 'fas fa-check p-1');

            }).catch(error => {
                this.showError(error);
            });
        },
        customLabel(service) {
            return `${service.name_ar}`
        },

        onImageChange(e) {
            this.item.image = e.target.files[0];
            this.item.image_url = URL.createObjectURL(e.target.files[0]);
            document.getElementById('clientPreviewUser').src = this.item.image_url;
        },

        showError(error) {
            let message_title = error.response.data.message + '\n';
            let errors = error.response.data.errors;
            let message = !errors ? message_title : '';
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
<style scoped>
.staff-members >>> .multiselect__tags {
    margin-left: -1px !important;
    border: none !important;
}
</style>
