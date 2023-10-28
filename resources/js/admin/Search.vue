<template>

    <div class="content" style="margin: 0 20px;">
        <div class="home-services card p-4">

            <div class="search-result px-10">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabs-1" type="button"
                                role="tab" aria-controls="tabs-1" aria-selected="true">{{__('general.All results')}}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabs-2" type="button" role="tab"
                                aria-controls="tabs-2" aria-selected="false">{{__('side_bar.Service providers')}}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabs-3" type="button" role="tab"
                                aria-controls="tabs-3" aria-selected="false">{{__('side_bar.Customers')}}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabs-4" type="button" role="tab"
                                aria-controls="tabs-4" aria-selected="false">{{__('side_bar.Invoices')}}
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <ContentLoader v-if="loading">
                        <div class="results mb-5">
                            <h2>{{__('side_bar.Service providers')}} (0)</h2>
                            <div class="clients-results d-xl-flex justify-content-between align-items-center">
                                <div class="loading-item" style="width: 200px;"></div>
                                <label class="loading-item" style="width: 200px;"></label>
                                <label class="loading-item" style="width: 200px;"></label>
                                <label class="loading-item" style="width: 200px;"></label>
                            </div>
                            <div class="clients-results d-xl-flex justify-content-between align-items-center">
                                <div class="loading-item" style="width: 200px;"></div>
                                <label class="loading-item" style="width: 200px;"></label>
                                <label class="loading-item" style="width: 200px;"></label>
                                <label class="loading-item" style="width: 200px;"></label>
                            </div>
                        </div>
                        <div class="results mb-5">
                            <h2>{{__('general.Customers')}} (0)</h2>
                            <div class="clients-results d-xl-flex justify-content-between align-items-center">
                                <div class="loading-item" style="width: 200px;"></div>
                                <label class="loading-item" style="width: 200px;"></label>
                                <label class="loading-item" style="width: 200px;"></label>
                                <label class="loading-item" style="width: 200px;"></label>
                            </div>
                        </div>
                        <div class="results mb-5">
                            <h2>{{__('side_bar.Invoices')}} (0)</h2>
                            <div class="clients-results d-xl-flex justify-content-between align-items-center">
                                <div class="loading-item" style="width: 200px;"></div>
                                <label class="loading-item" style="width: 200px;"></label>
                                <label class="loading-item" style="width: 200px;"></label>
                                <label class="loading-item" style="width: 200px;"></label>
                            </div>
                        </div>
                    </ContentLoader>
                    <div v-else class="tab-pane fade show active" id="tabs-1" role="tabpanel"
                         aria-labelledby="tabs-1-tab">
                        <div class="results mb-5">
                            <h2>{{__('side_bar.Service providers')}} ({{ service_providers.length }})</h2>
                            <div class="clients-results d-xl-flex justify-content-between align-items-center"
                                 v-for="item in service_providers"
                            >
                                <a href="#" >
                                    <img :title="item.title" v-if="item.logo"
                                         :src="item.logo_url">
                                    <span
                                        v-else
                                        :title="item.title"
                                        class=" rounded-circle badge-secondary"
                                        style="padding: 5px;width: 40px;height: 40px;margin-right: 4px;padding-top: 7px;text-align: center;color: white;background: rgb(29, 41, 57);font-size: 31px;display: inline-block;vertical-align: middle;font-family: auto;">
                                                    {{ (item.title.charAt(0)).toUpperCase() }}
                                                </span>
                                    {{ item.title }}
                                </a>
                                <label
                                       style="padding: 10px">{{ item.business_type.name }}</label>
                                <label
                                       style="padding: 10px">{{ item.service_for['name_ar'] }}</label>
                                <label
                                       style="padding: 10px">{{ item.city_name }} {{ item.district_name }} {{ item.address }}</label>
                            </div>
                        </div>
                        <div class="results mb-5">
                            <h2>{{__('side_bar.Customers')}} ({{ customers.length }})</h2>
                            <div class="clients-results box-time mb-4 d-lg-flex justify-content-between"
                                 v-for="client in customers">
                                <a href="#" >
                                    <img :title="client.full_name" v-if="client.image"
                                         :src="client.image_url">
                                    <span
                                        v-else
                                        :title="client.full_name"
                                        class=" rounded-circle badge-secondary"
                                        style="padding: 5px;width: 40px;height: 40px;margin-right: 4px;padding-top: 7px;text-align: center;color: white;background: rgb(29, 41, 57);font-size: 31px;display: inline-block;vertical-align: middle;font-family: auto;">
                                                    {{ (client.full_name.charAt(0)).toUpperCase() }}
                                                </span>
                                    {{ client.full_name }}
                                </a>
                                <label
                                    style="padding: 10px">{{ client.gender_text }}</label>
                                <label
                                    style="padding: 10px">+{{ client.mobile_country_code }}
                                    {{ client.mobile }}</label>
                                <label
                                    style="padding: 10px">{{ client.email }}</label>
                            </div>

                        </div>
                        <div class="results mb-5">
                            <h2>{{__('side_bar.Invoices')}} ({{ invoices.length }}) </h2>
                            <div class="clients-results d-xl-flex justify-content-between align-items-center"
                                 v-for="item in invoices">
                                <a href="#" >
                                    {{ item.invoice_id }}
                                </a>
                                <label
                                       style="padding: 10px">
                                    <a href="#" >
                                        <img :title="item.service_provider.title" v-if="item.service_provider.logo"
                                             :src="item.service_provider.logo_url">
                                        <span
                                            v-else
                                            :title="item.service_provider.title"
                                            class=" rounded-circle badge-secondary"
                                            style="padding: 5px;width: 40px;height: 40px;margin-right: 4px;padding-top: 7px;text-align: center;color: white;background: rgb(29, 41, 57);font-size: 31px;display: inline-block;vertical-align: middle;font-family: auto;">
                                                    {{ (item.service_provider.title.charAt(0)).toUpperCase() }}
                                                </span>
                                        {{ item.service_provider.title }}
                                    </a>
                                </label>
                                <label
                                       style="padding: 10px">{{ item.total }}</label>
                                <label
                                       style="padding: 10px">{{ item.formatted_created_at }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="tabs-2-tab">
                        <div class="results mb-5">
                            <h2>{{__('side_bar.Service providers')}} ({{ service_providers.length }})</h2>
                            <div class="clients-results box-time mb-4 d-lg-flex justify-content-between"
                                 v-for="item in service_providers">
                                <a href="#" >
                                    <img :title="item.title" v-if="item.logo"
                                         :src="item.logo_url">
                                    <span
                                        v-else
                                        :title="item.title"
                                        class=" rounded-circle badge-secondary"
                                        style="padding: 5px;width: 40px;height: 40px;margin-right: 4px;padding-top: 7px;text-align: center;color: white;background: rgb(29, 41, 57);font-size: 31px;display: inline-block;vertical-align: middle;font-family: auto;">
                                                    {{ (item.title.charAt(0)).toUpperCase() }}
                                                </span>
                                    {{ item.title }}
                                </a>
                                <label
                                    style="padding: 10px">{{ item.business_type.name }}</label>
                                <label
                                    style="padding: 10px">{{ item.service_for['name_ar'] }}</label>
                                <label
                                    style="padding: 10px">{{ item.city_name }} {{ item.district_name }} {{ item.address }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabs-3" role="tabpanel" aria-labelledby="tabs-3-tab">
                        <div class="results mb-5">
                            <h2>{{__('side_bar.Customers')}} ({{ customers.length }})</h2>
                            <div class="clients-results d-xl-flex justify-content-between align-items-center"
                                 v-for="client in customers"
                            >
                                <a href="#" class="">
                                    <img :title="client.full_name" v-if="client.image"
                                         :src="client.image_url">
                                    <span
                                        v-else
                                        :title="client.full_name"
                                        class=" rounded-circle badge-secondary"
                                        style="padding: 5px;width: 40px;height: 40px;margin-right: 4px;padding-top: 7px;text-align: center;color: white;background: rgb(29, 41, 57);font-size: 31px;display: inline-block;vertical-align: middle;font-family: auto;">
                                                    {{ (client.full_name.charAt(0)).toUpperCase() }}
                                                </span>
                                    {{ client.full_name }}
                                </a>
                                <label
                                    style="padding: 10px">{{ client.gender_text }}</label>
                                <label
                                    style="padding: 10px">+{{ client.mobile_country_code }}
                                    {{ client.mobile }}</label>
                                <label
                                    style="padding: 10px">{{ client.email }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabs-4" role="tabpanel" aria-labelledby="tabs-4-tab">
                        <div class="results mb-5">
                            <h2>{{__('side_bar.Invoices')}} ({{ invoices.length }}) </h2>
                            <div class="clients-results d-xl-flex justify-content-between align-items-center"
                                 v-for="item in invoices">
                                <a href="#" >
                                    {{ item.invoice_id }}
                                </a>
                                <label
                                    style="padding: 10px">
                                    <a href="#" >
                                        <img :title="item.service_provider.title" v-if="item.service_provider.logo"
                                             :src="item.service_provider.logo_url">
                                        <span
                                            v-else
                                            :title="item.service_provider.title"
                                            class=" rounded-circle badge-secondary"
                                            style="padding: 5px;width: 40px;height: 40px;margin-right: 4px;padding-top: 7px;text-align: center;color: white;background: rgb(29, 41, 57);font-size: 31px;display: inline-block;vertical-align: middle;font-family: auto;">
                                                    {{ (item.service_provider.title.charAt(0)).toUpperCase() }}
                                                </span>
                                        {{ item.service_provider.title }}
                                    </a>
                                </label>
                                <label
                                    style="padding: 10px">{{ item.total }}</label>
                                <label
                                    style="padding: 10px">{{ item.formatted_created_at }}</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

export default {
    name: "Home",
    components: {},
    data() {
        return {
            dashboard_search_text: '',
            loading: false,
            service_providers: [],
            customers: [],
            invoices: [],
        }
    },


    mounted() {
        this.get_search();
    },
    beforeRouteUpdate(to, from, next) {
        this.get_search()
    },
    methods: {
        get_search() {
            let dashboard_search_text = $('.dashboard_search_text').val()
            this.loading = true;
            axios.get('/vue/admin/control/search?q=' + dashboard_search_text).then((response) => {
                this.loading = false;
                this.tax = response.data.tax;
                this.service_providers = response.data.serviceProviders;
                this.customers = response.data.customers;
                this.invoices = response.data.invoices;
                window.scrollTo(0, 0);
            })
        },
    }

}
</script>


<style>
.apexcharts-legend-text {
    margin-right: 10px;
}
</style>
