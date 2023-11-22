<template>

    <div class="d-inline-block col-md-5 m-2">
        <div :style="style" :class="classes">
            <label class="form-label d-block text-center">
                {{ question.name }}
                <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" :data-bs-title="question.description" class="fa-solid fa-circle-question"></i>
            </label>
            <input type="text" v-model="selected_value" @keyup="change_answer" class="form-control">
        </div>
        <div v-if="classes" class="clearfix">

        </div>
    </div>
</template>

<script>
import emitter from "../../../emitter";

export default {
    props: {
        question: null,
        style:'',
        classes:'',
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
        },
        capitalizeFirstLetter(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
    }
}
</script>
