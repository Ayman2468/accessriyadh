<template>
    <div class="content" style="margin: 0 40px;">

        <div class="home-services card py-4 px-10" style="height: auto;    border-radius: 10px;">
            <div class="title-tab d-sm-flex align-items-start justify-content-between">
                <div>
                    <h2>الطلبات</h2>
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
                                   placeholder="البحث عن طلب">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 mb-3 ">
                        <div class="input-group mb-3 d-flex">
                            <span class="input-group-text"><img :src="'/dashboard/images/find.svg'"></span>
                            <select class="form-control" v-model="is_applied"
                                    style="background: white;border: 1px solid #d0cece;"
                                    @change="get_search_items">
                                <option value="1">مكتملة</option>
                                <option value="0">قيد الادخال</option>
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
                                    <th scope="col" >اسم المتقدم</th>
                                    <th scope="col" >العنوان</th>
                                    <th scope="col" >البريد الالكتروني</th>
                                    <th scope="col">نوع المبنى</th>
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
                <h3>لا يوجد طلبات.</h3>

            </div>
            <template v-else>
                <div class="all-clients all-staff">
                    <form>
                        <div class="table-responsive table-custom-responsive border-0" style="min-height: 300px;">
                            <table class="table table-columns-length " style="    width: 100%;">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">#</th>
                                    <th scope="col" >اسم المتقدم</th>
                                    <th scope="col" >العنوان</th>
                                    <th scope="col" >البريد الالكتروني</th>
                                    <th scope="col">نوع المبنى</th>
                                    <th scope="col">الاجراءات</th>
                                </tr>

                                </thead>
                                <tbody>
                                <template v-for="(item,index) in items.data">
                                    <tr>
                                        <td class="pt-1 pb-1">{{ item.id }}</td>
                                        <td>{{ item.full_name }}</td>
                                        <td>{{ item.street_address }}</td>
                                        <td>{{ item.email }}</td>
                                        <td>{{ item.building_type.name_ar }}</td>
                                        <td>
                                           <router-link class="btn btn-light" :to="'/admin/applications/'+(item.id)+''">عرض الطلب</router-link>
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
import Delete from "./Delete.vue";
//
export default {
    components: {},
    data() {
        return {
            items: {
                data: []
            },
            loading: true,
            all_current_page_items_selected: false,
            csrf_token: null,
            search_value: '',
            search_form: {
                from_date: '',
                to_date: '',
            },
            is_all_items_selected: false,
            clientsCount: null,
            current_page: null,
            awaitingSearch: false,
            is_applied: 1,
            selected_items: []
        }
    },
    async mounted() {
        this.csrf_token = $('input[name="_token"]').val();
        this.loading = false;
        await this.get_items();



    },
    methods: {
        get_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/admin/application?' + (this.get_query_params(page))).then((response) => {
                this.loading = false;
                this.items = response.data.data;
            })
        },

        get_page_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/admin/application?'+ (this.get_query_params(page))).then((response) => {
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
                    axios.get('/admin/application?' + (this.get_query_params(page))).then((response) => {
                        this.loading = false;
                        this.items = response.data.data;
                    })
                    this.awaitingSearch = false;
                }, 500); // 1 sec delay
            }
            this.awaitingSearch = true;
        },
        get_query_params(page,append = '') {
            return 'q=' + this.search_value + '&page=' + page + '&from_date=' + (this.search_form.from_date) + '&to_date=' + (this.search_form.to_date)+ '&is_applied=' + (this.is_applied)+''+append
        },
        change_status(item) {
            this.$root.$emit('selected_item_for_status', {
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
