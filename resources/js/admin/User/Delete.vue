<template>
    <!-- delete-service -->
    <div class="modal fade delete-category" id="delete-sub-admin" tabindex="-1" aria-labelledby=" delete-serviceLabel"
         aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body pb-0">
                    <h2>{{ __('general.Delete') }} “{{item.full_name}}” ?</h2>
                    <p>{{ __('sub_admin.Are you sure you want to delete this Sub-admin? This action cannot be undone') }}.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">{{ __('general.Cancel') }}</button>
                    <button type="button" class="btn btn-primary" @click="delete_item"  data-bs-dismiss="modal">{{ __('general.Confirm delete') }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'delete-services',
    components: {},
    data() {
        return {
            item: {
                title: null,
                id: null,
            },
        }
    },
    async mounted() {
        this.$root.$on('selected_item_for_delete', function (item) {
            this.item = item.item
        }.bind(this))
    },


    methods: {
        delete_item(e) {
            const config = {headers: {'Content-Type': 'multipart/form-data;', 'e': e}};

            axios.delete(
                '/vue/admin/user/' + this.item.id,
                new FormData(), config).then((response) => {
                this.notify('success', 'Doctor deleted successfully', 'fas fa-check p-1');
                this.$root.$emit('refresh-list')

            }).catch(error => {
                this.showError(error);
            });
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
<style scoped>
.staff-members >>> .multiselect__tags {
    margin-left: -1px !important;
    border: none !important;
}
</style>
