<template>
    <div class="content" style="margin: 0 40px;">

        <div class="home-services card py-4 px-10" style="height: auto;    border-radius: 10px;">
            <div class="title-tab d-sm-flex align-items-start justify-content-between">
                <div>
                    <h2>إدارة المستخدمين</h2>
                </div>
                <a class="btn btn-primary mb-4 rounded-0" href="/register">إضافة مدير/مشرف جديد
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <form>
               <div class="row">
                   <div class="col-lg-4 col-md-12 mb-3">
                       <div class="input-group mb-3 d-flex">
                           <span class="input-group-text"><img :src="'/dashboard/images/find.svg'"></span>
                           <input type="text" class="form-control" v-model="search_value"
                                  style="background: white;border: 1px solid #d0cece;"
                                  @input="get_search_items"
                                  placeholder="البحث من خلال الاسم او رقم الجوال">
                       </div>
                   </div>
                   <!-- <div class="col-lg-3 col-md-12 mb-3">

                       <select name="" class="form-control" @change="get_search_items"
                               v-model="role_search">
                           <option value="" selected="selected">
                               الصلاحية
                           </option>
                           <option v-for="(item,index) in roles"
                                   :value="item.key">{{
                                   item.name
                               }}
                           </option>
                       </select>
                   </div> -->
               </div>
            </form>
            <ContentLoader v-if="loading">
                <div class="all-clients">
                    <form>
                        <div class="table-responsive table-custom-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 25%;">الاسم</th>
                                    <!-- <th scope="col" style="width: 25%;">الهوية</th> -->
                                    <!-- <th scope="col" style="width: 15%;">رقم الجوال</th> -->
                                    <th scope="col" style="width: 20%;">الايميل</th>
                                    <!-- <th scope="col" style="width: 20%;">الصلاحية</th>
                                    <th scope="col" style="width: 15%;">حالة النشاط</th> -->
                                    <th scope="col" style="width: 25%;">الاجراءات</th>
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
            <div v-else-if="itemsCount == 0"
                 class="no-services d-flex justify-content-center align-items-center flex-column">
                <h3>لا يوجد مستخدمين.</h3>

            </div>
            <template v-else>
                <div class="all-clients all-staff">
                    <form>
                        <div class="table-responsive table-custom-responsive " style="min-height: 300px;">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 25%;">الاسم</th>
                                    <!-- <th scope="col" style="width: 10%;">الهوية</th> -->
                                    <!-- <th scope="col" style="width: 10%;">رقم الجوال</th> -->
                                    <th scope="col" style="width: 20%;">الايميل</th>
                                    <!-- <th scope="col" style="width: 10%;">الصلاحية</th> -->
                                    <!-- <th scope="col" style="width: 15%;">حالة النشاط</th> -->
                                    <th scope="col" style="width: 25%;">الاجراءات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item,index) in items">
                                    <td>{{ item.name }}</td>
                                    <!-- <td class="text-start">
                                        <label class="form-check-label position-relative form-check"
                                               :for="'flexCheckDefault'+index">
                                            <img :title="item.full_name"
                                                 v-if="item.image"
                                                 :src="item.image_url">
                                            <span
                                                v-else
                                                :title="item.full_name"
                                                class=" rounded-circle badge-secondary"
                                                style="padding: 0;width: 40px;height: 40px;margin-right: 4px; text-align: center;color: white;background: rgb(29, 41, 57);font-size: 22px;display: inline-block;vertical-align: middle;font-family: auto;">
                                                            {{ (item.full_name.charAt(0)).toUpperCase() }}
                                                        </span>

                                            {{ item.full_name  }}
                                        </label>
                                    </td>
                                    <td>{{ item.mobile }}</td> -->
                                    <td>{{ item.email }}</td>
                                    <!-- <td>{{ item.user_type  }}</td> -->
                                    <!-- <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input form-check-input-custom " type="checkbox" :id="'active-'+index" :name="'active-'+index"
                                                   style="float: none !important;margin: auto !important;" @change="change_user_status(item.id)" :checked="item.status">
                                        </div>
                                    </td> -->
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                <!-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                       data-bs-target="#edit-sub-admin"
                                                       @click="edit_item(item)"><i class="fa-solid fa-pen mx-2"></i>تعديل</a>
                                                </li> -->
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                       data-bs-target="#delete-sub-admin"
                                                       @click="delete_item(item.id)"><i class="fa-solid fa-trash mx-2 text-danger"></i>حذف</a></li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
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
                            <i class="fa fa-arrow-left me-2"></i>
                            السابق
                        </template>
                        <template #next-nav class="page-link pe-0" aria-label="Next">
                            التالى
                            <i class="fa fa-arrow-right ms-2"></i>
                        </template>

                    </pagination>
                </nav>
            </div>

        </div>
        <!--        <ImportServices/>-->
    </div>

</template>

<script>
import Add from "./Add.vue";
import Edit from "./Edit.vue";
import Delete from "./Delete.vue";

export default {
    components: {},
    data() {
        return {
            items: [],
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

        // this.$root.$on('/admin/users', function (lists) {
        //     this.items = lists.items
        //     this.itemsCount = lists.itemsCount != undefined ? lists.itemsCount : this.itemsCount
        //     //
        //     // this.mark_selected_before()
        // }.bind(this))
        // this.$root.$on('refresh-list', function (lists) {
        //     this.get_items();
        // }.bind(this))

        // this.$root.$on('delete_selected_item', function (item) {
        //     this.items.data.splice(item.index, 1)
        //     this.itemsCount--;
        // }.bind(this))
        // this.$root.$on('delete_selected_multiple_item', function () {
        //     this.itemsCount = this.itemsCount - this.selected_items.length;

        //     this.selected_items = [];
        //     this.is_all_items_selected = false;
        //     this.all_current_page_items_selected = false;
        // }.bind(this))


    },
    methods: {
        get_items(page = 1) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.loading = true;
            this.current_page = page;
            axios.get('/admin/users').then((response) => {
                //?q=' + this.search_value + '&page=' + page+'&role='+(this.role_search)
                this.loading = false;
                this.items = response.data.users;
                console.log(response.data);
                this.itemsCount = this.items.length;
            })
        },

        // get_page_items(page = 1) {
        //     if (typeof page === 'undefined') {
        //         page = 1;
        //     }
        //     this.loading = true;
        //     this.current_page = page;
        //     axios.get('/vue/admin/user/search/query?q=' + this.search_value + '&page=' + page+'&role='+(this.role_search)).then((response) => {
        //         this.loading = false;
        //         this.items = response.data.data;
        //     })
        // },
        // get_search_items(page = 1) {
        //     if (typeof page === 'undefined') {
        //         page = 1;
        //     }
        //     this.loading = true;
        //     this.current_page = page;
        //     if (!this.awaitingSearch) {
        //         setTimeout(() => {
        //             axios.get('/vue/admin/user/search/query?q=' + this.search_value + '&page=' + page+'&role='+(this.role_search)).then((response) => {
        //                 this.loading = false;
        //                 this.items = response.data.data;
        //             })
        //             this.awaitingSearch = false;
        //         }, 500); // 1 sec delay
        //     }
        //     this.awaitingSearch = true;
        // },
        // edit_item(item) {
        //     this.$root.$emit('selected_item_for_edit', {
        //         item: item,
        //         search_value: this.search_value,
        //         current_page: this.current_page,
        //     })
        // },
        delete_item(id) {
            axios.get('/admin/user/delete/'+id).then((response) => {
                if(response.data.message == 'success') this.showAlert('Success');
                else this.showAlert('Failed');
                this.get_items();
            })
        },
        // add_item() {
        //     this.$root.$emit('add_new_item', {
        //         search_value: this.search_value,
        //         current_page: this.current_page,
        //     })
        // },
        // change_user_status(id) {
        //     axios.put('/vue/admin/user/' + id + '/status').then((response) => {
        //     })
        // },
        // showError(error) {
        //     let message_title = error.response.data.message + '\n';
        //     let message = message_title;
        //     let errors = error.response.data.errors;
        //     $.each(errors, function (key, val) {
        //         $.each(val, function (key2, val2) {
        //             message += val2 + '\n'
        //         });
        //     });
        //     this.notify("error", message, 'fas fa-times p-1', 'danger')
        // },
        showAlert(msg) {
            // Use sweetalert2
            this.$swal(msg);
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
