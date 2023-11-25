<!-- Pagination.vue -->
<template>
    <div class="pagination">
      <button class="btn btn-secondary" @click="changePage('prev')" :disabled="currentPage === 1">{{ __('general.Prev') }}</button>
      <span>Page {{ currentPage }} of {{ totalPages }}</span>
      <button class="btn btn-secondary" @click="changePage('next')" :disabled="currentPage === totalPages">{{ __('general.Next') }}</button>
    </div>
  </template>

  <script>
  export default {
    props: {
      totalItems: {
        type: Number,
        required: true,
      },
      itemsPerPage: {
        type: Number,
        required: true,
      },
    },
    data() {
      return {
        currentPage: 1,
      };
    },
    computed: {
      totalPages() {
        return Math.ceil(this.totalItems / this.itemsPerPage);
      },
    },
    methods: {
      changePage(direction) {
        if (direction === 'prev' && this.currentPage > 1) {
          this.currentPage--;
        } else if (direction === 'next' && this.currentPage < this.totalPages) {
          this.currentPage++;
        }

        this.$emit('page-change', this.currentPage);
      },
    },
  };
  </script>

  <style scoped>
  /* Add your pagination styling here */
  .pagination {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }
  </style>
