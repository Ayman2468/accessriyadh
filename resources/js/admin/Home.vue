<template>

        <div class="content">
            1111
        </div>
</template>

<script>


export default {
    name: "Home",
    components: {},
    data() {
        return {
            loading: false,
        }
    },
    mounted() {

    },
    methods: {
        get_items() {

            this.loading = true;
            axios.get('/vue/admin/statistics').then((response) => {
                this.loading = false;
                this.allCustomersCount = response.data.allCustomersCount
                this.inProcessCustomersCount = response.data.inProcessCustomersCount
                this.inCompleteCustomersCount = response.data.inCompleteCustomersCount
                this.inFirstPhaseCustomersCount = response.data.inFirstPhaseCustomersCount
                this.inSecondPhaseCustomersCount = response.data.inSecondPhaseCustomersCount
                this.inThirdPhaseCustomersCount = response.data.inThirdPhaseCustomersCount
                this.prescriptionsCustomersCount = response.data.prescriptionsCustomersCount
                this.doctorsCount = response.data.doctorsCount
                this.receptionsCount = response.data.receptionsCount
                this.psychologistsCount = response.data.psychologistsCount
                this.familiesCount = response.data.familiesCount
                this.religiousCount = response.data.religiousCount
                this.customerStates = response.data.customerStates

            })
        },
        view_booking(booking) {
            this.$root.$emit('selected_item_for_edit', {
                booking: booking,
                search_value: this.search_value,
                current_page: this.current_page,
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
