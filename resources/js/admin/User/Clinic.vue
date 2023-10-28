<template>
    <div class="content" style="margin: 0 40px;">

        <div class="home-services card py-4 px-10" style="height: auto;    border-radius: 10px;">
            <div class="title-tab d-sm-flex align-items-start justify-content-between">
                <div>
                    <h2>عرض العيادات</h2>
                </div>
                <div class="add-services d-flex">
                    <div class="dropdown mx-2">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenu2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            اجراءات
                            <i class="fa-solid fa-angle-down ms-2"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li>
                                <a class="dropdown-item"
                                   :href="'/excel/export/clinic-doctor'+'?'+ (get_query_params('','&ext_type=excel'))"
                                   target="_blank">
                                    تصدير النتائج المعروضة كـ Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                   :href="'/excel/export/clinic-doctor'+'?'+(get_query_params('','&ext_type=csv'))"
                                   target="_blank">
                                    تصدير النتائج المعروضة كـ CSV
                                </a>
                            </li>


                        </ul>
                    </div>

                </div>
            </div>
            <form>
                <div class="row">
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="input-group mb-3 d-flex">
                            <span class="input-group-text"><img src="/images/find.svg"></span>
                            <input type="text" class="form-control" v-model="search_value"
                                   style="background: white;border: 1px solid #d0cece;"
                                   @input="get_search_items"
                                   placeholder="البحث من خلال الاسم او رقم الجوال">
                        </div>
                    </div>

                </div>
            </form>
            <ContentLoader v-if="loading">
                <div class="all-clients">
                    <form>
                        <div class="table-responsive table-custom-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 15%;">الاسم</th>
                                    <th scope="col" style="width: 15%;">عدد المستفيدين</th>
                                    <th scope="col" style="width: 15%;">عدد قيد العلاج</th>
                                    <th scope="col" style="width: 15%;">عدد المرحلة الاولى</th>
                                    <th scope="col" style="width: 15%;">عدد المرحلة الثانية</th>
                                    <th scope="col" style="width: 15%;">عدد المرحلة الثالثة</th>
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
                <h3>لا يوجد أطباء.</h3>

            </div>
            <template v-else>
                <div class="all-clients all-staff">
                    <form>
                        <div class="table-responsive table-custom-responsive " style="min-height: 300px;">
                            <table class="table table-bordered">
                                <tbody>
                                <template v-for="(item,index) in items.data">
                                    <tr>
                                        <td colspan="10" style="border: 0;">
                                            <div class="card mb-3"
                                                 style="width: 100%;border: 1px solid rgba(0,0,0,.125);">
                                                <!--                                              background-color:rgba(0, 0, 0, 0.075);-->
                                                <div class="card-header d-flex justify-content-between">
                                                    <div class="fw-bold p-2">
                                                        {{ item.name }}
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                    </div>

                                                </div>
                                                <div class="card-body pt-0 pb-0" style="padding: 12px;">
                                                    <div class="row">
                                                        <div
                                                            class="col-md-3 ps-0 d-flex justify-content-start customer-table-info-cell ">
                                                            <label>رقم الهوية: </label>
                                                            <div class="fw-bold mx-2">{{ item.identity }}</div>
                                                        </div>
                                                        <div
                                                            class="col-md-3  ps-0 d-flex justify-content-start customer-table-info-cell">
                                                            <label>عدد المستفيدين: </label>
                                                            <div class="fw-bold mx-2">{{ item.all_customers }}</div>
                                                        </div>
                                                        <div
                                                            class="col-md-3  ps-0 d-flex justify-content-start customer-table-info-cell">
                                                            <label>عدد قيد العلاج: </label>
                                                            <div class="fw-bold mx-2">{{ item.customers_in_process }}</div>
                                                        </div>
                                                        <div
                                                            class="col-md-3  ps-0 d-flex justify-content-start customer-table-info-cell">
                                                            <label>عدد المرحلة الاولى: </label>
                                                            <div class="fw-bold mx-2">{{ item.in_first_phase }}</div>
                                                        </div>
                                                        <div
                                                            class="col-md-3  ps-0 d-flex justify-content-start customer-table-info-cell">
                                                            <label>عدد المرحلة الثانية: </label>
                                                            <div class="fw-bold mx-2" >
                                                                {{ item.in_second_phase }}
                                                            </div>
                                                         </div>
                                                        <div
                                                            class="col-md-3  ps-0 d-flex justify-content-start customer-table-info-cell">
                                                            <label>عدد المرحلة الثالثة: </label>
                                                            <div class="fw-bold mx-2" >
                                                                {{ item.in_third_phase }}
                                                            </div>
                                                         </div>
                                                        <div
                                                            class="col-md-3  ps-0 d-flex justify-content-start customer-table-info-cell">
                                                            <label>  المتعافي: </label>
                                                            <div class="fw-bold mx-2">
                                                                {{ item.recover_1 }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-3  ps-0 d-flex justify-content-start customer-table-info-cell">
                                                            <label>قريب من التعافي: </label>
                                                            <div class="fw-bold mx-2">
                                                                {{ item.recover_2 }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-3  ps-0 d-flex justify-content-start customer-table-info-cell">
                                                            <label>متوسط بين التعافي والادمان: </label>
                                                            <div class="fw-bold mx-2">
                                                                {{ item.recover_3 }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-3  ps-0 d-flex justify-content-start customer-table-info-cell">
                                                            <label>غير متعافي ومدمن: </label>
                                                            <div class="fw-bold mx-2">
                                                                {{ item.recover_4 }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-3  ps-0 d-flex justify-content-start customer-table-info-cell">
                                                            <label>غير متعافي ومدمن جدا: </label>
                                                            <div class="fw-bold mx-2">
                                                                {{ item.recover_5 }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
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
        <!--        <ImportServices/>-->
    </div>

</template>

<script>
import Add from "./Add";
import Edit from "./Edit";
import Delete from "./Delete";
import Vue from "vue";
//
Vue.component('add-sub-admin', Add);
Vue.component('edit-sub-admin', Edit);
Vue.component('delete-sub-admin', Delete);
export default {
    components: {},
    data() {
        return {
            items: {
                data: []
            },
            roles: [
                {key: 'super-admin', name: 'مدير'},
                {key: 'doctor', name: 'طبيب عام'},
                {key: 'reception', name: 'موظف استقبال'},
                {key: 'psychologist', name: 'طبيب نفسي'},
                {key: 'family', name: 'طبيب ارشاد اسري'},
                {key: 'religious', name: 'طبيب ارشاد ديني'},
            ],
            loading: true,
            all_current_page_items_selected: false,
            role_search: '',
            csrf_token: null,
            search_value: '',
            is_all_items_selected: false,
            clientsCount: null,
            current_page: null,
            awaitingSearch: false,
            selected_items: []
        }
    },
    async mounted() {
        this.csrf_token = $('input[name="_token"]').val();
        await this.get_items();

        this.$root.$on('clients_paginated_list', function (lists) {
            this.items = lists.items
            this.itemsCount = lists.itemsCount != undefined ? lists.itemsCount : this.itemsCount
            //
            // this.mark_selected_before()
        }.bind(this))
        this.$root.$on('refresh-list', function (lists) {
            this.get_items();
        }.bind(this))

        this.$root.$on('delete_selected_item', function (item) {
            this.items.data.splice(item.index, 1)
            this.itemsCount--;
        }.bind(this))
        this.$root.$on('delete_selected_multiple_item', function () {
            this.itemsCount = this.itemsCount - this.selected_items.length;

            this.selected_items = [];
            this.is_all_items_selected = false;
            this.all_current_page_items_selected = false;
        }.bind(this))


    },
    methods: {
        get_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/vue/admin/user?q=' + this.search_value + '&page=' + page + '&role=' + (this.role_search)+'&type=clinic').then((response) => {
                this.loading = false;
                this.items = response.data.data;
                this.itemsCount = response.data.itemsCount;
            })
        },

        get_page_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/vue/admin/user/search/query?q=' + this.search_value + '&page=' + page + '&role=' + (this.role_search)+'&type=clinic').then((response) => {
                this.loading = false;
                this.items = response.data.data;
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
                    axios.get('/vue/admin/user/search/query?q=' + this.search_value + '&page=' + page + '&role=' + (this.role_search)+'&type=clinic').then((response) => {
                        this.loading = false;
                        this.items = response.data.data;
                    })
                    this.awaitingSearch = false;
                }, 500); // 1 sec delay
            }
            this.awaitingSearch = true;
        },
        get_query_params(page,append) {
            return 'q=' + this.search_value + '&page=' + page + '&role=' + (this.role_search)+'&type=clinic'+''+append
        },
        edit_item(item) {
            this.$root.$emit('selected_item_for_edit', {
                item: item,
                search_value: this.search_value,
                current_page: this.current_page,
            })
        },
        delete_item(category, index) {
            this.$root.$emit('selected_item_for_delete', {
                item: category,
                index: index,
                search_value: this.search_value,
                current_page: this.current_page,
            })
        },
        add_item() {
            this.$root.$emit('add_new_item', {
                search_value: this.search_value,
                current_page: this.current_page,
            })
        },
        change_user_status(id) {
            axios.put('/vue/admin/user/' + id + '/status').then((response) => {
            })
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
