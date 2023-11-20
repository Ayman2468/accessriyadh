<template>
    <div class="content" style="margin: 0 40px;">
        <div class="home-services card py-4 px-10" style="height: auto;    border-radius: 10px;min-height: initial;">
            <div class="title-tab d-sm-flex align-items-start justify-content-between">
                <div>
                    <h2>عرض بيانات الطلب</h2>
                </div>

            </div>

        </div>
    </div>
    <div class="content" style="margin: 0 40px;padding-top: 0;">

        <div class="home-services card py-4 px-10" style="height: auto;    border-radius: 10px;">
            <div class="title-tab d-sm-flex align-items-start justify-content-between">
                <div>
                    <h2>بيانات المتقدم</h2>
                </div>

            </div>
            <ContentLoader v-if="loading">
                <form class="">
                    <div class="row mt-2">
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <div class="loading-item" style="width: 150px;"></div>
                        </div>

                    </div>
                </form>
            </ContentLoader>
            <template v-else>
                <form class="">
                    <div class="row mt-2">
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>الاسم الكامل</label>
                            <div class="fw-bold">{{ item.full_name }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>البريد الالكتروني</label>
                            <div class="fw-bold">{{ item.email }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>اسم وعنوان المبنى</label>
                            <div class="fw-bold">{{ item.building_or_business_name }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>عنوان المكان</label>
                            <div class="fw-bold">{{ item.street_address }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>المدينة</label>
                            <div class="fw-bold">{{ item.city }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>الحي</label>
                            <div class="fw-bold">{{ item.district }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>الرمز البريدي</label>
                            <div class="fw-bold">{{ item.postal_code }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>رقم المخطط</label>
                            <div class="fw-bold">{{ item.deed_number }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>رقم قطعة الارض</label>
                            <div class="fw-bold">{{ item.plot_number }}</div>
                        </div>
                    </div>
                </form>
                <div class="title-tab d-sm-flex align-items-start justify-content-between mt-5">
                    <div>
                        <h2>إجابات النموذج</h2>
                    </div>
                    </div>
                    <form class="">
                        <div class="row mt-2">
                            <div v-for="(item,index) in answers" class="col-lg-12 col-md-12 mb-3">
                                <label>{{item.question_name_ar}}</label>
                                <div class="fw-bold">{{ item.answer }}</div>
                            </div>
                        </div>
                    </form>
            </template>

        </div>
    </div>

</template>

<script>
import Delete from "./Delete.vue";
import emitter from "../../emitter";

//
export default {
    components: {},
    data() {
        return {
            item: {},
            answers: [],
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

    },
    methods: {
        get_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/admin/application/' + (this.$route.params.id) + '/show?' + (this.get_query_params(page))).then((response) => {
                this.loading = false;
                this.item = response.data.data;
                this.answers = response.data.answers;
            })
        },

        get_page_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/admin/application/' + (this.$route.params.id) + '/show?' + (this.get_query_params(page))).then((response) => {
                this.loading = false;
                this.items = response.data.data;
                this.answers = response.data.answers;
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
                    axios.get('/admin/application/' + (this.$route.params.id) + '/show?' + (this.get_query_params(page))).then((response) => {
                        this.loading = false;
                        this.items = response.data.data;
                        this.answers = response.data.answers;
                    })
                    this.awaitingSearch = false;
                }, 500); // 1 sec delay
            }
            this.awaitingSearch = true;
        },
        get_query_params(page, append = '') {
            return 'q=' + this.search_value + '&page=' + page + '&phase_id=' + (this.phase_id) + '' + append
        },


        edit_item(item) {
            emitter.$emit('question-edit', item)

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
