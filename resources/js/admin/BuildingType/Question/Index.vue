<template>
    <div class="content" style="margin: 0 40px;">
        <div class="home-services card py-4 px-10" style="height: auto;    border-radius: 10px;min-height: initial;">
            <div class="title-tab d-sm-flex align-items-start justify-content-between">
                <div>
                    <h2>اضافة سؤال</h2>
                </div>

            </div>
            <form class="">
                <div class="row mt-2">
                    <div class="col-lg-4 col-md-12 mb-3">
                        <select class="form-control" v-model="form.type"
                                style="background: white;border: 1px solid #d0cece;"
                        >
                            <option value="question">سؤال</option>
                            <option value="title">عنوان</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
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
                    <div class="col-lg-4 col-md-12 mb-3">
                        <input type="text" class="form-control" v-model="form.web_id"
                               style="background: white;border: 1px solid #d0cece;"
                               placeholder="رقم السؤال في الويب">
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <select class="form-control" v-model="form.title_id"
                                style="background: white;border: 1px solid #d0cece;">
                            <option value="">ما هو عنوان السؤال</option>
                            <template v-if="title_items.length"  v-for="(title,index) in title_items">
                                <option  v-if="title.type == 'title'" :value="title.id">
                                    {{title.question_name_en}}
                                </option>
                            </template>
                        </select>
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
                    <h2>الاسئلة الخاصة بالمبنى</h2>
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
                                    <th scope="col">#</th>
                                    <th scope="col">نص السؤال</th>
                                    <th scope="col">المرحلة</th>
                                    <th scope="col">الترتيب</th>
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
                                    <td>
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
                                    <td>
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
                                    <td>
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
            <div v-else-if="!items.length"
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
                                    <th scope="col" style="width: 50%;">نص السؤال</th>
                                    <th scope="col">النوع</th>
                                    <th scope="col" style="width: 10%;">المرحلة</th>
                                    <th scope="col" style="width: 10%;">الترتيب</th>
                                    <th scope="col">الاجراءات</th>
                                </tr>

                                </thead>
                                <tbody>
                                <template v-for="(item,index) in items">
                                    <tr>
                                        <td class="pt-1 pb-1">{{ item.web_id }}</td>
                                        <td style="text-align: right;direction: ltr"
                                            :class="item.type == 'title' ? 'fw-bold' : ''">{{ item.question_name_en }}
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
                                        <td style="text-align: right">
                                            <select class="form-control"
                                                    @change="change_title($event,item)"
                                                    v-model="item.title_id"
                                                    style="background: white;border: 1px solid #d0cece;">
                                                <option value="">ما هو عنوان السؤال</option>
                                                <template v-if="title_items.length"  v-for="(title,index) in title_items">
                                                    <option  v-if="title.type == 'title'" :value="title.id">
                                                        {{title.question_name_en}}
                                                    </option>
                                                </template>
                                            </select>
                                        </td>
                                        <td>
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
                                               data-bs-target="#edit-question"
                                               @click="edit_item(item,index)">
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
                    <pagination :data="items" :limit="10"
                                @pagination-change-page="get_page_items">
                        <template #prev-nav class="page-link ps-0" aria-label="Previous">
                            <i class="fa-solid fa-arrow-left me-2"></i>
                            {{ __('general.prev') }}
                        </template>
                        <template #next-nav class="page-link pe-0" aria-label="Next">
                            {{ __('general.next') }}
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </template>

                    </pagination>
                </nav>
            </div>

        </div>
    </div>

</template>

<script>
import emitter from "../../../emitter";

//
export default {
    components: {},
    data() {
        return {
            items: [],
            title_items: [],
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
                title_id: '',
                answers: []
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
            awaitingSearch: false,
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
        emitter.$on('edited-item', (data) => {
            this.items[data.index] = data.item;
        });
    },
    methods: {
        get_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/admin/building-type/' + (this.$route.params.id) + '/questions?' + (this.get_query_params(page))).then((response) => {
                this.loading = false;
                this.items = response.data.data;
                this.get_title_items();
            })
        },

        get_page_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/admin/building-type/' + (this.$route.params.id) + '/questions?' + (this.get_query_params(page))).then((response) => {
                this.loading = false;
                this.items = response.data.data;
                this.get_title_items();
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
                    axios.get('/admin/building-type/' + (this.$route.params.id) + '/questions?' + (this.get_query_params(page))).then((response) => {
                        this.loading = false;
                        this.items = response.data.data;
                        this.get_title_items();
                    })
                    this.awaitingSearch = false;
                }, 500); // 1 sec delay
            }
            this.awaitingSearch = true;
        },
        get_query_params(page, append = '') {
            return 'q=' + this.search_value + '&page=' + page + '&phase_id=' + (this.phase_id) + '' + append
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
            formData.append('title_id', this.form.title_id);
            for (let i = 0; i < this.form.answers.length; i++) {
                console.log(this.form.answers[i].answer,'this.form.answers[i].answer')
                formData.append('answers[' + i + '][en]', this.form.answers[i].en);
                formData.append('answers[' + i + '][ar]', this.form.answers[i].ar);
                formData.append('answers[' + i + '][image]', this.form.answers[i].image);
            }
            axios.post('/admin/building-type/' + (this.$route.params.id) + '/questions/store', formData).then((response) => {
                this.loading = false;
                this.items = response.data.data;
                this.form.question_name_ar = '';
                this.form.question_name_en = '';
                this.form.description_name_ar = '';
                this.form.description_name_en = '';
            })
        },
        get_title_items(){
            for (let i = 0; i < this.items.length; i++) {
                if (this.items[i].type == 'title') this.title_items.push(this.items[i])
            }
        },
        up_slide(index, slide) {
            let arr = this.items;
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
            this.items = arr
            for (let i = 0; i < this.items.length; i++) {
                this.items[i].order = i;
            }
            this.save_order()
        },
        down_slide(index, slide) {
            let arr = this.items;
            let new_index = index;
            let old_index = index + 1;
            if (new_index >= arr.length) {
                var k = new_index - arr.length + 1;
                while (k--) {
                    arr.push(undefined);
                }
            }
            arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
            this.items = arr
            for (let i = 0; i < this.items.length; i++) {
                this.items[i].order = i;
            }
            this.save_order()
        },
        save_order() {
            axios.post('/admin/building-type/' + (this.$route.params.id) + '/questions/order', {questions: this.items}).then((response) => {
                this.loading = false;
                // this.items = response.data.data;
            })
        },
        change_phase(event, item) {
            const selectedValue = event.target.value;
            console.log(selectedValue)
            axios.post('/admin/building-type/' + (this.$route.params.id) + '/questions/phase', {
                id: item.id,
                phase: selectedValue
            }).then((response) => {
                this.loading = false;
                // this.items = response.data.data;
            })
        },
        change_title(event, item) {
            const selectedValue = event.target.value;
             axios.post('/admin/building-type/' + (this.$route.params.id) + '/questions/title', {
                id: item.question_id,
                title_id: selectedValue
            }).then((response) => {
                this.loading = false;
                // this.items = response.data.data;
            })
        },

        add_answer() {
            this.form.answers.push({ar: '', en: '', image: ''})
        },

        edit_item(item,index) {
            emitter.$emit('question-edit', {item:item,title_items:this.title_items,index:index})
        },
        setImage(e, index) {

            const file = e.target.files[0];
            this.form.answers[index].image = e.target.files[0];
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
