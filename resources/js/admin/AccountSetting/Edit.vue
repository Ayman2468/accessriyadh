<template>
    <div class="content">
            <div class="edit-profile card py-4 px-10 ">
                <BlockUI message="Loading.." v-if="loading">
                    <i class="fa fa-cog fa-spin fa-2x fa-fw"></i>
                </BlockUI>
                <form>
                    <div class="box-tab mb-4 p-4">
                        <a href="javascript:void(0);" @click="update_personal_info"
                           class="btn btn-primary float-end ms-3">{{ __('general.save') }}</a>

                        <h2>{{ __('setting.Personal details') }}</h2>
                        <p>{{ __('setting.Set your name and contact info here, The email address entered here is used for your login access') }}.</p>
                        <div class="change-avatar-img position-relative">
                            <input type="file" class="profile-img"
                                   v-on:change="onLogoChange">
                            <img :src="user.image_url ? user.image_url : '/images/avatar-profile.svg'"
                                 id="profilePreview">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">{{ __('setting.First name') }}</label>
                                <input type="text" v-model="user.first_name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">{{ __('setting.Last name') }}</label>
                                <input type="text" v-model="user.last_name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">{{ __('setting.Email address') }}</label>
                                <input type="email" v-model="user.email" class="form-control">
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-mob">
                                    <label class="form-label">{{ __('setting.Mobile') }}</label>
                                    <div class="input-group">
                                        <select class="form-select" style="padding: 0.375rem 0.1rem;"
                                                v-model="user.mobile_country_code">
                                            <template v-for="item in countries">
                                                <option v-for="code in item.calling_codes.split(',')" :value="code">
                                                    +{{ code }}
                                                </option>
                                            </template>
                                        </select>
                                        <input type="number" v-model="user.mobile" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form>
                    <div class="box-tab mb-4 p-4">
                        <a href="javascript:void(0);" @click="update_my_password" class="btn btn-primary float-end ms-3">{{ __('general.save') }}</a>
                        <h2>{{ __('setting.Change password') }}</h2>
                        <p>{{ __("setting.Choose a unique password to protect your account. If you don't know your existing password, you can log out and use the Reset Password link on the Log In page") }}.</p>
                        <div class="col-md-12 my-4 position-relative">
                            <label for="myPassword" class="form-label">{{ __('setting.Current password') }} </label>
                            <input type="password" v-model="current_password" class="form-control" id="myPassword">
                            <a class="show-pass d-block" href="javascript:void(0);" @click="ShowPass('myPassword')"><i class="fa-solid fa-eye"></i></a>
                        </div>
                        <div class="col-md-12 mb-4 position-relative">
                            <label for="myPassword1" class="form-label">{{ __('setting.New password') }}</label>
                            <input type="password" v-model="new_password" class="form-control" id="myPassword1">
                            <a class="show-pass d-block" href="javascript:void(0);" @click="ShowPass('myPassword1')"><i class="fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</template>

<script>

export default {
    components: {
    },
    data() {
        return {
            user: {},
            countries: [],
            loading: true,
            current_password: null,
            new_password: null,
        }
    },
    async mounted() {
        await this.get_personal_info();
    },


    methods: {
        get_personal_info() {
            axios.get('/vue/admin/account/me').then((response) => {
                this.loading = false;
                this.countries = response.data.countries;
                this.user = response.data.data;
                if (!this.user.mobile_country_code) this.user.mobile_country_code = 966;
            })
        },
        update_personal_info(e) {
            const config = {headers: {'Content-Type': 'multipart/form-data;', 'e': e}};
            const formData = new FormData();
            formData.append('first_name', this.user.first_name);
            formData.append('last_name', this.user.last_name);
            formData.append('mobile_country_code', this.user.mobile_country_code);
            formData.append('mobile', this.user.mobile);
            formData.append('email', this.user.email);
            formData.append('image', this.user.image);

            axios.post(
                '/vue/admin/account/me',
                formData, config).then((response) => {
                let user = response.data.user;
                if (user.image){
                    $('#sidebar-profileImg,.nav-bar-logo').attr('src', user.image_url);
                }

                $('#sidebar-username,.navbar-username').text(user.full_name);
                this.notify('success', 'Your personal info updated successfully', 'fas fa-check p-1');
            }).catch(error => {
                this.showError(error);
            });
        },
        onLogoChange(e) {
            this.user.image = e.target.files[0];
            this.user.image_url = URL.createObjectURL(e.target.files[0]);
            document.getElementById('profilePreview').src = this.user.image_url;
        },
        update_my_password(e) {
            const config = {headers: {'Content-Type': 'multipart/form-data;', 'e': e}};
            const formData = new FormData();
            formData.append('current_password', this.current_password);
            formData.append('new_password', this.new_password);

            axios.post(
                '/vue/admin/account/me/password',
                formData, config).then((response) => {
                this.notify('success', 'Password updated successfully', 'fas fa-check p-1');
                this.$root.user.last_password_change = response.data.last_change
            }).catch(error => {
                this.showError(error);
            });
        },
        ShowPass(id) {
            var x = document.getElementById(id);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
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
<style>
.display-time {
    line-height: 1.5em;
    height: 2.5em !important;
    background: #F2F4F7;
    border-radius: 8px;
    border: 0;
    width: 84%;
}

.display-time:focus {
    border: 1px solid #790a1f;
    box-shadow: none;
    transition: 0.3s;
}

@media (max-width: 1350px) {

    .display-time {
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>
