<template>
    <div class="content">
            <div class="edit-profile card py-4 px-10 ">
                <BlockUI message="Loading.." v-if="loading">
                    <i class="fa fa-cog fa-spin fa-2x fa-fw"></i>
                </BlockUI>
                <form>
                    <div class="box-tab mb-4 p-4">
                        <a href="javascript:void(0);" @click="update_personal_info"
                           class="btn btn-primary float-end ms-3">حفظ</a>

                        <h2>التفاصيل الشخصية</h2>
                        <p>ادخل اسمك و بيانات التواصل هنا, البريد الالكترونى الذى ستدخله سيتم استعماله لتسجيل الدخول لاحقا</p>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">الاسم</label>
                                <input type="text" v-model="user.name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">البريد  الالكترونى</label>
                                <input type="email" v-model="user.email" class="form-control">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">كلمة السر</label>
                                <input type="password" v-model="user.password" class="form-control">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">تاكيد كلمة السر</label>
                                <input type="password" v-model="user.password_confirmation" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
                <form>
                    <div class="box-tab mb-4 p-4">
                        <a href="javascript:void(0);" @click="update_my_password" class="btn btn-primary float-end ms-3">حفظ</a>
                        <h2>تغيير كلمة السر</h2>
                        <p>اختر كلمة مرور فريدة لحماية حسابك. إذا كنت لا تعرف كلمة المرور الحالية، فيمكنك تسجيل الخروج واستخدام رابط إعادة تعيين كلمة المرور الموجود في صفحة تسجيل الدخول</p>
                        <div class="col-md-12 my-4 position-relative">
                            <label for="myPassword" class="form-label">كلمة السر الحاليه </label>
                            <input type="password" v-model="current_password" class="form-control" id="myPassword">
                            <a class="show-pass d-block" href="javascript:void(0);" @click="ShowPass('myPassword')"><i class="fa-solid fa-eye"></i></a>
                        </div>
                        <div class="col-md-12 mb-4 position-relative">
                            <label for="myPassword1" class="form-label">كلمة السر</label>
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
            axios.get('/admin/user/profile').then((response) => {
                this.loading = false;
                this.user = response.data.user;
            })
        },
        update_personal_info(e) {
            const config = {headers: {'Content-Type': 'multipart/form-data;', 'e': e}};
            const formData = new FormData();
            formData.append('name', this.user.name);
            formData.append('email', this.user.email);
            axios.post(
                '/admin/user/update/'+this.user.id,
                formData, config).then((response) => {
                let user = response.data.user;
                console.log(response.data.message);
                // if (user.image){
                //     $('#sidebar-profileImg,.nav-bar-logo').attr('src', user.image_url);
                // }

                $('#sidebar-username,.navbar-username').text(user.name);
                this.$swal('تم تعديل بياناتك الشخصية بنجاح');
            }).catch(error => {
                this.showError(error);
            });
        },
        // onLogoChange(e) {
        //     this.user.image = e.target.files[0];
        //     this.user.image_url = URL.createObjectURL(e.target.files[0]);
        //     document.getElementById('profilePreview').src = this.user.image_url;
        // },
        update_my_password(e) {
            const config = {headers: {'Content-Type': 'multipart/form-data;', 'e': e}};
            const formData = new FormData();
            formData.append('current_password', this.current_password);
            formData.append('new_password', this.new_password);

            axios.post(
                '/admin/user/change-password/'+this.user.id,
                formData, config).then((response) => {
                    console.log(response.data);
                this.$swal('تم تحديث كلمة السر بنجاح');
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
            console.log(error);
            let message_title = error.response.data.message + '\n';
            let message = message_title;
            let errors = error.response.data.errors;
            $.each(errors, function (key, val) {
                $.each(val, function (key2, val2) {
                    message += val2 + '\n'
                });
            });
            this.$swal(message)
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
