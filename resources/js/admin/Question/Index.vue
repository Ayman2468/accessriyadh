<template>
    <div class="content" style="margin: 0 40px;">
        <div class="home-services card py-4 px-10"
             :style="'  border-radius: 10px;min-height: initial;'+(is_open_new_question ? 'height: auto;' : 'height: 80px;')">
            <div class="title-tab d-sm-flex align-items-start justify-content-between">
                <div>
                    <h2 @click="">
                        <a href="#" class="btn btn-primary rounded-0" @click="add_new_question_toggle"> سؤال جديد</a>
                    </h2>
                </div>

            </div>
            <form class="" v-if="is_open_new_question">
                <div class="row mt-2">
                    <div class="col-lg-3 col-md-12 mb-3">
                        <select class="form-control" v-model="form.is_all_building"
                                @change="change_building_type_option"
                                style="background: white;border: 1px solid #d0cece;">
                            <option value="0">جميع المباني</option>
                            <option value="1">تحديد مباني</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-12 mb-3" v-if="form.is_all_building == '1'">
                        <select name="tags[]" multiple="multiple"
                                class="form-control tags-select building_type_id select2"
                                style="background: white;border: 1px solid #d0cece;">
                            <option v-for="item in building_types" :value="item.id">{{ item.name_ar }}</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-12 mb-3">
                        <select class="form-control" v-model="form.type"
                                style="background: white;border: 1px solid #d0cece;"
                        >
                            <option value="question">سؤال</option>
                            <option value="title">عنوان</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-12 mb-3">
                        <select class="form-control" v-model="form.phase_id"
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
                    <div class="col-lg-3 col-md-12 mb-3">
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
                        <input type="text" class="form-control" v-model="form.description_name_ar"
                               style="background: white;border: 1px solid #d0cece;"
                               placeholder="الوصف عربي">
                    </div>
                    <div class="col-lg-3 col-md-12 mb-3">
                        <input type="text" class="form-control" v-model="form.description_name_en"
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
                            <a href="#" class="btn btn-light" @click="add_answer"> <i class="fa fa-plus"></i></a>
                        </div>
                        <div class="row mt-2" v-for="(answer,index) in form.answers">
                            <div class="col-3">
                                <input type="text" class="form-control" v-model="form.answers[index].en"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="نص الاجابة باللغة الانجليزية">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" v-model="form.answers[index].ar"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="نص الاجابة باللغة عربية">
                            </div>
                            <div class="col-3">
                                <input type="file" class="form-control" @change="setImage($event,index)"
                                       style="background: white;border: 1px solid #d0cece;"
                                       placeholder="اختر صورة">
                            </div>
                            <div class="col-lg-3 col-md-12 mb-3">
                                <input type="text" class="form-control" v-model="form.answers[index].score"
                                    style="background: white;border: 1px solid #d0cece;"
                                    placeholder="عدد النقاط">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="#" class="btn btn-primary" @click="store_item"> اضافة سؤال/عنوان </a>
                </div>
            </form>
        </div>
    </div>
    <div class="content" style="margin: 0 40px;padding-top: 0;">

        <div class="home-services card py-4 px-10" style="height: auto;    border-radius: 10px;">
            <div class="title-tab d-sm-flex align-items-start justify-content-between">
                <div>
                    <h2>ادارة الاسئلة</h2>
                </div>

            </div>

            <form class="">
                <div class="row mt-2">
                    <div class="col-lg-3 col-md-12 mb-3">
                        <div class="input-group mb-3 d-flex">
                            <span class="input-group-text"><img :src="'/dashboard/images/find.svg'"></span>
                            <input type="text" class="form-control" v-model="search_value"
                                   style="background: white;border: 1px solid #d0cece;"
                                   @input="get_search_items"
                                   placeholder="البحث عن السؤال">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 mb-3 d-none">
                        <div class="input-group mb-3 d-flex">
                            <span class="input-group-text"><img :src="'/dashboard/images/find.svg'"></span>
                            <select class="form-control" v-model="building_type_id"
                                    style="background: white;border: 1px solid #d0cece;"
                                    @change="get_search_items">
                                <option value="">جميع المباني</option>
                                <option v-for="item in building_types" :value="item.id">{{ item.name_ar }}</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 mb-3">
                        <div class="input-group mb-3 d-flex">
                            <span class="input-group-text"><img :src="'/dashboard/images/find.svg'"></span>
                            <select class="form-control" v-model="phase_id"
                                    style="background: white;border: 1px solid #d0cece;"
                                    @change="get_search_items">
                                <option value="">اختر مرحلة</option>
                                <option value="1">المرحلة 1</option>
                                <option value="2">المرحلة 2</option>
                                <option value="3">المرحلة 3</option>
                                <option value="4">المرحلة 4</option>
                                <option value="5">المرحلة 5</option>
                                <option value="6">المرحلة 6</option>
                            </select>

                        </div>
                    </div>
                </div>
            </form>
            <ContentLoader v-if="loading">
                <div class="all-clients">
                    <form>
                        <div class="table-responsive table-custom-responsive">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th scope="col" >#</th>
                                    <th scope="col" >نص السؤال</th>
                                    <th scope="col" >المرحلة</th>
                                    <th v-if="search_value == ''" scope="col" >الترتيب</th>
                                    <th scope="col">الاجراءات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td v-if="search_value == ''">
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td v-if="search_value == ''">
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td v-if="search_value == ''">
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                    <td>
                                        <div class="loading-item" style="width: 150px;"></div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </ContentLoader>
            <div v-else-if="!items.data.length"
                 class="no-services d-flex justify-content-center align-items-center flex-column">
                <h3>لا يوجد اسئلة.</h3>

            </div>
            <template v-else>
                <div class="all-clients all-staff">
                    <form>
                        <div class="table-responsive table-custom-responsive border-0" style="min-height: 300px;">
                            <table class="table table-columns-length " style="    width: 100%;">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">#</th>
                                    <th scope="col" style="width: 30%;">نص السؤال</th>
                                    <th scope="col" style="width: 30%;">المباني</th>
                                    <th scope="col">النوع</th>
                                    <th scope="col" style="width: 10%;">المرحلة</th>
                                    <th v-if="search_value == ''" scope="col" style="width: 10%;">الترتيب</th>
                                    <th scope="col">الاجراءات</th>
                                </tr>

                                </thead>
                                <tbody>
                                <template v-for="(item,index) in items.data">
                                    <tr>
                                        <td class="pt-1 pb-1">{{ item.web_id }}</td>
                                        <td style="text-align: right;direction: ltr"
                                            :class="item.type == 'title' ? 'fw-bold' : ''">{{ item.question_name_en }}
                                        </td>
                                        <td>
                                            <template
                                                v-if="item.building_type_question && item.building_type_question.length > 0 && (!item.show_list_build_types)"
                                                v-for="(building_type,building_type_index) in item.building_type_question"
                                            >
                                                <span
                                                    v-if="(building_type_index < 2)"
                                                    class="badge bg-primary me-1" style="background-color: #70b083 !important;">
                                                {{building_type.building_type ?  building_type.building_type.name_ar : '' }}
                                            </span>
                                            </template>
                                            <template
                                                v-if="item.building_type_question && item.building_type_question.length > 0 && item.show_list_build_types">
                                                <span
                                                    v-for="(building_type,building_type_index) in item.building_type_question"
                                                    class="badge bg-primary me-1" style="background-color: #70b083 !important;">
                                                {{building_type.building_type ?  building_type.building_type.name_ar : '' }}
                                            </span>
                                            </template>
                                           <div style="padding: 0 40px;font-size: 12px;">
                                               <a href="javascript:void(0);" style="display: block;width: 100%;background: #f9f9f9;color: #7b7b7b;padding: 3px"
                                                  @click="item.show_list_build_types = !item.show_list_build_types"
                                                  v-if="item.building_type_question.length >= 3">
                                                   {{ item.show_list_build_types ? 'اخفاء' : 'عرض المزيد' }}
                                               </a>
                                           </div>
                                        </td>
                                        <td>
                                            <span v-if="item.type == 'title'" class="badge bg-primary">عنوان</span>
                                            <span v-if="item.type == 'question'" class="badge bg-warning">سؤال</span>
                                        </td>
                                        <td style="text-align: right">
                                            <select name="" v-model="item.phase_id" @change="change_phase($event,item)"
                                                    class="form-control" id="">
                                                <option value="1">المرحلة 1</option>
                                                <option value="2">المرحلة 2</option>
                                                <option value="3">المرحلة 3</option>
                                                <option value="4">المرحلة 4</option>
                                                <option value="5">المرحلة 5</option>
                                                <option value="6">المرحلة 6</option>
                                            </select>
                                        </td>
                                        <td v-if="search_value == ''">
                                            <a href="javascript:void(0)" style="" class="up-btn mx-1"
                                               @click="up_slide(index,item)">
                                                <img :src="'/dashboard/images/up.png'" style="width: 30px" alt="">
                                            </a>
                                            <a href="javascript:void(0)" style="" class="down-btn mx-1"
                                               @click="down_slide(index,item)">
                                                <img :src="'/dashboard/images/down.png'" style="width: 30px" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-light" href="#" data-bs-toggle="modal"
                                               data-bs-target="#edit-question-general"
                                               @click="edit_item(item)">
                                                <i class="fa fa-pencil"></i>
                                                تعديل
                                            </a>
                                            <!--                                            <router-link class="btn btn-light"-->
                                            <!--                                                         :to="'/admin/building-type/'+(item.id)+'/questions'">ادارة-->
                                            <!--                                                الاسئلة-->
                                            <!--                                            </router-link>-->
                                        </td>
                                    </tr>

                                </template>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </template>
            <div class="pagination-box mt-4">
                <nav aria-label="Page navigation example">

                    <pagination :data="items" :limit="15"
                                @pagination-change-page="get_page_items">
                        <template #prev-nav class="page-link ps-0" aria-label="Previous">
                            <i class="fa-solid fa-arrow-left me-2"></i>
                            السابق
                        </template>
                        <template #next-nav class="page-link pe-0" aria-label="Next">
                            التالي
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </template>

                    </pagination>
                </nav>
            </div>

        </div>
    </div>

</template>

<script>
import Delete from "./Delete.vue";
import emitter from "../../emitter";
import * as pagination from 'laravel-vue-pagination';

//
export default {
    components: {pagination},
    data() {
        return {
            items: {
                data: []
            },
            form: {
                type: 'question',
                web_id: '',
                phase_id: 1,
                question_name_ar: '',
                question_name_en: '',
                description_name_ar: '',
                description_name_en: '',
                order: '',
                score: '',
                building_type_id: [],
                is_all_building: '0',
                answers: [],
                answers_key_value: [],
            },
            phase_id: '',
            loading: true,
            all_current_page_items_selected: false,
            csrf_token: null,
            edit_key: 0,
            search_value: '',
            search_form: {
                from_date: '',
                to_date: '',
            },
            is_all_items_selected: false,
            clientsCount: null,
            current_page: null,
            is_open_new_question: false,
            awaitingSearch: false,
            building_type_id: [],
            building_types: [],
            selected_items: []
        }
    },
    async mounted() {
        this.csrf_token = $('input[name="_token"]').val();
        this.loading = false;
        await this.get_items();
        emitter.$on('refresh-list', () => {
            this.get_items();
        });

        let that = this;
        $(document).on('change', '.building_type_id', function () {
            that.form.building_type_id = $(this).val()
            return false;
        });
    },
    methods: {
        get_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/admin/question?' + (this.get_query_params(page))).then((response) => {
                this.loading = false;
                this.items = response.data.questions;
                this.building_types = response.data.building_types;
                $('.tags-select').select2({
                    // tags: true,
                    tokenSeparators: [',', ' ']
                })
            })
        },

        get_page_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/admin/question?search=1&' + (this.get_query_params(page))).then((response) => {
                this.loading = false;
                this.items = response.data.questions;
            })
        },
        get_search_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            if (!this.awaitingSearch) {
                setTimeout(() => {
                    axios.get('/admin/question?search=1&' + (this.get_query_params(page))).then((response) => {
                        this.loading = false;
                        this.items = response.data.questions;
                    })
                    this.awaitingSearch = false;
                }, 500); // 1 sec delay
            }
            this.awaitingSearch = true;
        },
        get_query_params(page, append = '') {
            return 'q=' + this.search_value + '&page=' + page + '&phase_id=' + (this.phase_id) + '&building_type_id=' + (this.building_type_id) + '' + append
        },
        up_slide(index, slide) {
            let arr = this.items.data;
            let new_index = index;
            let old_index = index - 1;
            if (new_index >= arr.length) {
                var k = new_index - arr.length + 1;
                while (k--) {
                    arr.push(undefined);
                }
            }
            let item = arr.splice(old_index, 1)[0];
            arr.splice(new_index, 0, item);
            this.items.data = arr
            for (let i = 0; i < this.items.data.length; i++) {
                this.items.data[i].order = i;
            }
            this.save_order()
        },
        down_slide(index, slide) {
            let arr = this.items.data;
            let new_index = index;
            let old_index = index + 1;
            if (new_index >= arr.length) {
                var k = new_index - arr.length + 1;
                while (k--) {
                    arr.push(undefined);
                }
            }
            arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
            this.items.data = arr
            for (let i = 0; i < this.items.data.length; i++) {
                this.items.data[i].order = i;
            }
            this.save_order()
        },
        save_order() {
            axios.post('/admin/question/order', {questions: this.items.data}).then((response) => {
                this.loading = false;
                // this.items = response.data.data;
            })
        },
        change_phase(event, item) {
            const selectedValue = event.target.value;
            console.log(selectedValue)
            axios.post('/admin/question/phase', {id: item.id, phase: selectedValue}).then((response) => {
                this.loading = false;
                // this.items = response.data.data;
            })
        },
        store_item() {
            const formData = new FormData();
            formData.append('question_name_ar', this.form.question_name_ar);
            formData.append('question_name_en', this.form.question_name_en);
            formData.append('description_ar', this.form.description_ar);
            formData.append('description_en', this.form.description_en);
            formData.append('type', this.form.type);
            formData.append('phase_id', this.form.phase_id);
            formData.append('web_id', this.form.web_id);
            formData.append('score', this.form.score);
            formData.append('is_all_building', this.form.is_all_building);
            formData.append('building_type_id', this.form.building_type_id);
            for (let i = 0; i < this.form.building_type_id.length; i++) {
                formData.append('building_type_id[' + i + ']', this.form.building_type_id[i]);
                formData.append('building_type_id[' + i + ']', this.form.building_type_id[i]);
            }
            for (let i = 0; i < this.form.answers.length; i++) {
                formData.append('answers[' + i + '][en]', this.form.answers[i].en);
                formData.append('answers[' + i + '][ar]', this.form.answers[i].ar);
                formData.append('answers[' + i + '][image]', this.form.answers[i].image);
            }
            axios.post('/admin/question/store?search=1&' + (this.get_query_params(1)), formData).then((response) => {
                this.loading = false;
                this.items = response.data.data;
                this.form.question_name_ar = '';
                this.form.question_name_en = '';
                this.form.description_name_ar = '';
                this.form.description_name_en = '';
            })
        },
        add_answer() {
            this.form.answers.push({ar: '', en: '', image: '',score:''})

        },
        setImage(e, index) {

            const file = e.target.files[0];
            this.form.answers[index].image = e.target.files[0];
        },

        edit_item(item) {
            emitter.$emit('question-edit', item)

        },
        change_building_type_option() {
            $('.tags-select').select2({
                // tags: true,
                tokenSeparators: [',', ' ']
            })
        },
        add_new_question_toggle() {
            this.is_open_new_question = !this.is_open_new_question
            setTimeout(function () {
                $('.tags-select').select2({
                    // tags: true,
                    tokenSeparators: [',', ' ']
                })
            }, 50)
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
