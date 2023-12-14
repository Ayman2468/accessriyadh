<template>
    <div
        v-if="applications.data && applications.data[0]"
        class="accordion container my-3"
        id="accordionExample"
    >
        <div class="accordion-item" v-for="application in applications.data">
            <h2 class="accordion-header" id="headingOne">
                <button
                    class="accordion-button collapsed p-1"
                    type="button"
                    data-bs-toggle="collapse"
                    :data-bs-target="'#collapse' + application.id"
                    aria-expanded="false"
                    aria-controls="collapseOne"
                >
                    <!-- <span class="col-9"
                        >{{ __("audit.Application Information") }} #{{
                            application.id
                        }}
                        - {{ application.building_or_business_name }}</span
                    >
                    <span class="col-2"
                        >{{
                            application.compliance_score > 50
                                ? __("audit.application_completed")
                                : __("audit.application_not_complete")
                        }}
                        {{
                            application.compliance_score.toFixed(2) + "%"
                        }}</span
                    > -->
                    <div
                        class="home-services py-0 px-10"
                        style="height: auto; border-radius: 10px"
                    >
                        <div
                            class="px-2 title-tab d-sm-flex align-items-start justify-content-between"
                        >
                            <div>
                                <h2>{{ __("audit.Applicant Information") }}</h2>
                            </div>
                        </div>
                        <div class="px-2 row">
                            <div class="col-lg-3 col-md-12 mb-2">
                                <label>{{ __("audit.Full Name") }}</label>
                                <div class="fw-bold">
                                    {{ application.full_name }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 mb-2">
                                <label>{{ __("audit.Email") }}</label>
                                <div class="fw-bold">
                                    {{ application.email }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 mb-2">
                                <label>{{
                                    __("audit.Building or Business Name")
                                }}</label>
                                <div class="fw-bold">
                                    {{ application.building_or_business_name }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 mb-2">
                                <label>{{ __("audit.Street Address") }}</label>
                                <div class="fw-bold">
                                    {{ application.street_address }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 mb-2">
                                <label>{{ __("audit.City") }}</label>
                                <div class="fw-bold">
                                    {{ application.city }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 mb-2">
                                <label>{{ __("audit.District") }}</label>
                                <div class="fw-bold">
                                    {{ application.district }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 mb-2">
                                <label>{{
                                    __("audit.ZIP / Postal Code")
                                }}</label>
                                <div class="fw-bold">
                                    {{ application.postal_code }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 mb-2">
                                <label>{{ __("audit.Deed Number") }}</label>
                                <div class="fw-bold">
                                    {{ application.deed_number }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 mb-2">
                                <label>{{ __("audit.Plot Number") }}</label>
                                <div class="fw-bold">
                                    {{ application.plot_number }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 mb-2">
                                <label>{{ __("audit.Status") }}</label>
                                <div class="fw-bold">
                                    {{application.compliance_score > 50 ? __("audit.application_completed") : __("audit.application_not_complete")}}
                                    {{application.compliance_score.toFixed(2) + "%"}}
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
            </h2>
            <div
                :id="'collapse' + application.id"
                class="accordion-collapse collapse"
                aria-labelledby="headingOne"
                data-bs-parent="#accordionExample"
            >
                <div class="accordion-body">
                    <div class="content" style="margin: 0 40px">
                        <div
                            class="home-services py-4 px-10"
                            style="
                                height: auto;
                                border-radius: 10px;
                                min-height: initial;
                            "
                        >
                            <div
                                class="title-tab d-sm-flex align-items-start justify-content-between"
                            >
                                <div
                                    class="px-2 d-flex justify-content-end w-100"
                                >
                                    <!-- <h2>
                                        {{ __("audit.Show Application Data") }}
                                    </h2> -->
                                    <a
                                        class="btn btn-secondary"
                                        style="height: initial"
                                        href="#"
                                        @click="print_item(application.id)"
                                        >{{ __("audit.print_application") }}</a
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <!-- <div class="home-services card py-4 px-10" style="height: auto;    border-radius: 10px;">
                    <div class="px-2 title-tab d-sm-flex align-items-start justify-content-between">
                        <div>
                            <h2>{{ __('audit.Applicant Information') }}</h2>
                        </div>
                    </div>
                    <div class="px-2 row mt-2">
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>{{ __('audit.Full Name') }}</label>
                            <div class="fw-bold">{{ application.full_name }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>{{ __('audit.Email') }}</label>
                            <div class="fw-bold">{{ application.email }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>{{ __('audit.Building or Business Name') }}</label>
                            <div class="fw-bold">{{ application.building_or_business_name }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>{{ __('audit.Street Address') }}</label>
                            <div class="fw-bold">{{ application.street_address }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>{{ __('audit.City') }}</label>
                            <div class="fw-bold">{{ application.city }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>{{ __('audit.District') }}</label>
                            <div class="fw-bold">{{ application.district }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>{{ __('audit.ZIP / Postal Code') }}</label>
                            <div class="fw-bold">{{ application.postal_code }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>{{ __('audit.Deed Number') }}</label>
                            <div class="fw-bold">{{ application.deed_number }}</div>
                        </div>
                        <div class="col-lg-3 col-md-12 mb-3">
                            <label>{{ __('audit.Plot Number') }}</label>
                            <div class="fw-bold">{{ application.plot_number }}</div>
                        </div>
                    </div>
                </div> -->
                            <div
                                class="px-2 title-tab d-sm-flex align-items-start justify-content-between mt-5"
                            >
                                <div>
                                    <h2>
                                        {{ __("audit.Application Answers") }}
                                    </h2>
                                </div>
                            </div>
                            <div class="px-2 row mt-2">
                                <div
                                    v-for="(item, index) in application.answers"
                                    class="col-lg-12 col-md-12 mb-3"
                                >
                                    <label v-if="lang == 'ar'">{{
                                        item.question_name_ar
                                    }}</label>
                                    <label v-else>{{
                                        item.question_name_en
                                    }}</label>
                                    <div class="fw-bold" v-if="lang == 'ar'">
                                        {{ item.answer_ar }}
                                    </div>
                                    <div class="fw-bold" v-else>
                                        {{ item.answer }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="d-flex align-items-center justify-content-center vh-100">
        <div class="my-3">
            <p class="alert alert-light h3">
                {{ __("audit.No Completed Applications Found") }}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    data() {
        return {
            applications: [],
            lang: document.documentElement.lang,
        };
    },
    async mounted() {
        this.get_items();
    },
    methods: {
        get_items() {
            this.loading = true;
            axios.get("/landing/audit/userApplications").then((response) => {
                this.loading = false;
                this.applications = response.data;
                // console.log(this.applications.data[0]);
            });
        },
        print_item(id) {
            axios
                .get("/application-export/" + id + "?locale=" + this.lang)
                .then((response) => {
                    if (response?.data?.message == "success")
                        this.showAlert("Success");
                    else this.showAlert(response?.data?.message);
                });
        },
    },
};
</script>
<style></style>
