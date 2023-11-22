<template>
    <!-- delete-service -->
    <div class="modal fade " id="edit-question-general" tabindex="-1" aria-labelledby=" edit-serviceLabel"
         aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>تعديل سؤال</h2>
                </div>
                <div class="modal-body pb-0">
                    <form class="">
                        <div class="row mt-2">
                            <div class="col-lg-4 col-md-12 mb-3">
                                <select   class="form-control" v-model="form.type"
                                          style="background: white;border: 1px solid #d0cece;"
                                >
                                    <option value="question">سؤال</option>
                                    <option value="title">عنوان</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12 mb-3">
                                <select   class="form-control" v-model="form.phase_id"
                                          style="background: white;border: 1px solid #d0cece;"
                                >
                                    <option value="1">المرحلة 1</option>
                                    <option value="2">المرحلة 2</option>
                                    <option value="3">المرحلة 3</option>
                                    <option value="4">المرحلة 4</option>
                                    <option value="5">المرحلة 5</option>
                                    <option value="6">المرحلة 6</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12 mb-3">
                                <input type="text" class="form-control" v-model="form.web_id"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="رقم السؤال في الويب">
                            </div>
                            <div class="col-lg-3 col-md-12 mb-3">
                                <input type="text" class="form-control" v-model="form.question_name_ar"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="الاسم عربي">
                            </div>
                            <div class="col-lg-3 col-md-12 mb-3">
                                <input type="text" class="form-control" v-model="form.question_name_en"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="الاسم انجليزي">
                            </div>
                            <div class="col-lg-3 col-md-12 mb-3">
                                <input type="text" class="form-control" v-model="form.description_ar"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="الوصف عربي">
                            </div>
                            <div class="col-lg-3 col-md-12 mb-3">
                                <input type="text" class="form-control" v-model="form.description_en"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="الوصف انجليزي">
                            </div>
                            <div class="col-lg-3 col-md-12 mb-3">
                                <input type="text" class="form-control" v-model="form.score"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="عدد النقاط">
                            </div>
                            <div class="col-lg-12 col-md-12 mb-3">
                                <div class="d-flex justify-content-between w-25">
                                    <h5>الاجابات</h5>
                                    <a href="#" class="btn btn-light" @click="add_answer"> <i
                                        class="fa fa-plus"></i></a>
                                </div>
                                <div class="row mt-2" v-for="(answer,index) in form.answers_key_value">
                                    <div class="col-3">
                                        <input type="text" class="form-control"
                                               v-model="form.answers_key_value[index].en"
                                               style="background: white;border: 1px solid #d0cece;"
                                               placeholder="نص الاجابة باللغة الانجليزية">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control"
                                               v-model="form.answers_key_value[index].ar"
                                               style="background: white;border: 1px solid #d0cece;"
                                               placeholder="نص الاجابة باللغة العربية">
                                    </div>
                                    <div class="col-3">
                                        <input type="file" class="form-control" @change="setImage($event,index)"
                                               style="background: white;border: 1px solid #d0cece;"
                                               placeholder="اختر صورة">
                                    </div>
                                    <div class="col-3">
                                    <input type="text" class="form-control" v-model="form.answers_key_value[index].score"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="عدد النقاط">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">إلغاء الامر</button>
                    <button type="button" class="btn btn-primary" @click="update_item" >حفظ التغييرات</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import emitter from "../../emitter";

export default {
    name:'delete-services',
    components: {},
    data() {
        return {
            form:{
                type:'question',
                id:'',
                web_id:'',
                phase_id:1,
                question_name_ar:'',
                question_name_en:'',
                description_ar:'',
                description_en:'',
                order:'',
                score:'',
                answers:[],
                answers_key_value:[],
            },
            item: {
                title: null,
                id: null,
            },
        }
    },
    async mounted() {
        emitter.$on('question-edit', (item) => {
            this.form = item
            console.log(this.form);
        });
    },


    methods: {
        update_item(e) {
            const config = {headers: {'Content-Type': 'multipart/form-data;', 'e': e}};
            const formData = new FormData();
            formData.append('question_name_ar', this.form.question_name_ar);
            formData.append('question_name_en', this.form.question_name_en);
            formData.append('description_ar', this.form.description_ar);
            formData.append('description_en', this.form.description_en);
            formData.append('type', this.form.type);
            formData.append('phase_id', this.form.phase_id);
            formData.append('web_id', this.form.web_id);
            formData.append('score', this.form.score);
            formData.append('title_id', this.form.title_id);
            for (let i = 0; i < this.form.answers_key_value.length; i++) {
                formData.append('answers[' + i + '][en]', this.form.answers_key_value[i].en);
                formData.append('answers[' + i + '][ar]', this.form.answers_key_value[i].ar);
                formData.append('answers[' + i + '][image]', this.form.answers_key_value[i].image);
                formData.append('answers[' + i + '][score]', this.form.answers_key_value[i].score);
            }
            axios.post('/admin/question/'+(this.form.id)+'/update',formData).then((response) => {
                this.loading = false;
                emitter.$emit('refresh-list')
                $('#edit-question-general').modal('toggle')
                this.$router.go();
            })
        },
        add_answer(){
            //this.form.answers_key_value.push([{'answer':'','image':'',}])
            this.form.answers_key_value.push({ar: '', en: '', image: '', score: ''})
        },
        setImage(e, index) {
            const file = e.target.files[0];
            this.form.answers_key_value[index].image = e.target.files[0];
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
