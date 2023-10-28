<template>
    <div class="content" style="margin: 0 40px;">

        <div class="home-services card py-4 px-10" style="height: auto;    border-radius: 10px;">
            <div class="title-tab d-sm-flex align-items-start justify-content-between">
                <div>
                    <h2>أنواع المباني</h2>
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
                                   placeholder="البحث عن مبنى">
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
                                    <th scope="col" >الصورة</th>
                                    <th scope="col">الاسم</th>
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
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </ContentLoader>
            <div v-else-if="!items.data.length"
                 class="no-services d-flex justify-content-center align-items-center flex-column">
                <h3>لا يوجد انواع مباني.</h3>

            </div>
            <template v-else>
                <div class="all-clients all-staff">
                    <form>
                        <div class="table-responsive table-custom-responsive border-0" style="min-height: 300px;">
                            <table class="table table-columns-length " style="    width: 100%;">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">#</th>
                                    <th scope="col" style="width: 20%">الصورة</th>
                                    <th scope="col" style="width: 20%;">الاسم</th>
                                    <th scope="col">الاجراءات</th>
                                </tr>

                                </thead>
                                <tbody>
                                <template v-for="(item,index) in items.data">
                                    <tr>
                                        <td class="pt-1 pb-1">{{ item.id }}</td>
                                        <td><img :src="item.image_url" style="width: 75px;" alt=""></td>
                                        <td style="text-align: right">{{ item.name_ar }}</td>

                                        <td>
                                           <router-link class="btn btn-light" :to="'/admin/building-types/'+(item.id)+'/questions'">ادارة الاسئلة</router-link>
                                            <a class="btn btn-light mx-2" href="#" data-bs-toggle="modal"
                                               data-bs-target="#edit-building-type"
                                               @click="edit_item(item,index)">
                                                <i class="fa fa-pencil"></i>
                                                تعديل
                                            </a>
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
import emitter from "../../emitter";
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
            selected_items: []
        }
    },
    async mounted() {
        this.csrf_token = $('input[name="_token"]').val();
        this.loading = false;
        await this.get_items();

        emitter.$on('edited-building-type-item', (data) => {
            this.items.data[data.index] = data.item;
        });

    },
    methods: {
        get_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/admin/building-type?' + (this.get_query_params(page))).then((response) => {
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
            axios.get('/admin/building-type?'+ (this.get_query_params(page))).then((response) => {
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
                    axios.get('/admin/building-type?' + (this.get_query_params(page))).then((response) => {
                        this.loading = false;
                        this.items = response.data.data;
                    })
                    this.awaitingSearch = false;
                }, 500); // 1 sec delay
            }
            this.awaitingSearch = true;
        },
        get_query_params(page,append = '') {
            return 'q=' + this.search_value + '&page=' + page + '&from_date=' + (this.search_form.from_date) + '&to_date=' + (this.search_form.to_date)+''+append
        },
        change_status(item) {
            this.$root.$emit('selected_item_for_status', {
                item: item,
                search_value: this.search_value,
                current_page: this.current_page,
            })
        },
        transfer_to_doctor_item(item) {
            this.$root.$emit('selected_item_for_transfer', {
                item: item,
                search_value: this.search_value,
                current_page: this.current_page,
            })
        },
        measure_item(item) {
            this.$root.$emit('selected_item_for_measure', {
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
        change_congrats_status(id) {
            axios.put('/vue/admin/congrats/' + id + '/status').then((response) => {
            })
        },
        view_customer_profile(item) {
            this.$router.push({
                path: '/control/customers/' + item.id + '/details',
            })
        },
        item_render(item, index, type = 'enter') {
            if (type === 'enter')
                this.items.data[index].show = true
            else
                this.items.data[index].show = false

            this.$forceUpdate()
            console.log(this.items.data[index].show)
        },
        get_column_span() {
            return $('.table-columns-length thead tr th').length;
        },
        edit_item(item,index) {
            emitter.$emit('building-type-edit', {item:item,index:index})
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
