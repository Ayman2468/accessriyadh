<template>
    <!-- delete-service -->
    <div class="modal fade " id="edit-building-type" tabindex="-1" aria-labelledby=" edit-serviceLabel"
         aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>تعديل مبنى</h2>
                </div>
                <div class="modal-body pb-0">
                    <form class="">
                        <div class="row mt-2">

                            <div class="col-lg-3 col-md-12 mb-3">
                                <input type="text" class="form-control" v-model="form.name_ar"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="الاسم عربي">
                            </div>
                            <div class="col-lg-3 col-md-12 mb-3">
                                <input type="text" class="form-control" v-model="form.name_en"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="الاسم انجليزي">
                            </div>
                            <div class="col-lg-3 col-md-12 mb-3">
                                <input type="file" class="form-control choose-image-input" @change="setImage($event)"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="اختر صورة">
                            </div>

                        </div>

                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">إلغاء الامر
                    </button>
                    <button type="button" class="btn btn-primary" @click="update_item">حفظ التغييرات</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import emitter from "../../emitter";

export default {
    name: 'delete-services',
    components: {},
    data() {
        return {
            form: {
                name_ar: '',
                name_en: '',
                image: '',
            },
            index:null,
        }
    },
    async mounted() {
        emitter.$on('building-type-edit', (data) => {
            this.form = data.item
            this.index = data.index
            $('.choose-image-input').val('')
        });

    },


    methods: {
        update_item(e) {
            const config = {headers: {'Content-Type': 'multipart/form-data;', 'e': e}};
            const formData = new FormData();
            formData.append('name_ar', this.form.name_ar);
            formData.append('name_en', this.form.name_en);
            formData.append('image', this.form.image);
            axios.post('/admin/building-type/' + (this.form.id) + '/update', formData).then((response) => {
                this.loading = false;
                emitter.$emit('edited-building-type-item', {item:response.data.data,index:this.index})
                $('#edit-building-type').modal('toggle')


            })
        },
        setImage(e, index) {
            const file = e.target.files[0];
            this.form.image = e.target.files[0];
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
<style scoped>
.staff-members >>> .multiselect__tags {
    margin-left: -1px !important;
    border: none !important;
}
</style>
