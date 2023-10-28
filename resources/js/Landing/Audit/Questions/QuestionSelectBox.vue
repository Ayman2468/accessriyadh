<template>
    <div class="form-block form-block-inner mt-3 mb-4" :id="'web-id-'+question.web_id">
        <label class="form-label">
            {{ question.name }}
            <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" :data-bs-title="question.description"
               class="fa-solid fa-circle-question"></i>
        </label>
        <select class="form-select" v-model="selected_value" @click="change_answer()">
            <option v-for="item in question.answers_array" :value="item['en']">{{ item[question.locale] }}</option>
        </select>
    </div>

</template>

<script>
import emitter from "../../../emitter";

export default {
    props: {
        question: null
    },
    components: {},
    data() {
        return {
            selected_value: ''
        }
    },
    async mounted() {
        if (this.question.application_answer){
            this.selected_value = this.question.application_answer.answer
            this.change_answer()
        }
    },
    methods: {
        change_answer() {
            emitter.$emit('question' + (this.question.web_id) + '-answer', this.selected_value)
        }
    }
}
</script>
