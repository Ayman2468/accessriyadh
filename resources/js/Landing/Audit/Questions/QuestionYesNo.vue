<template>
    <div class="form-block mb-4 form-block-radio" v-if="question" :id="'web-id-'+question.web_id">
        <div class="row">
            <div class="col-md-12 mb-2">
                <label class="form-label">
                    {{ question.name }}
                    <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true"
                       :data-bs-title="question.description" class="fa-solid fa-circle-question"></i>
                </label>
            </div>
            <div class="col-sm-6 col-6" v-for="(answer,index) in question.answers_array">
                <button :class="['btn','btn-outline-dark','w-100',selected_value == answer['en'] ? 'checked' : '']"
                        type="button" @click="change_answer( answer['en'])">
                    <input type="radio" name="parking">
                    {{ capitalizeFirstLetter(answer[question.locale]) }}
                </button>
            </div>
<!--            <div class="col-sm-6 col-6">-->
<!--                <button :class="['btn','btn-outline-dark','w-100',selected_value == Object.keys(question.answers_array)[1] ? 'checked' : '']"-->
<!--                        type="button" @click="change_answer(Object.keys(question.answers_array)[1])">-->
<!--                    <input type="radio" name="parking">-->
<!--                    {{ capitalizeFirstLetter(Object.keys(question.answers_array)[1]) }}-->
<!--                </button>-->
<!--            </div>-->
        </div>
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
            this.change_answer(this.selected_value)
        }
    },
    methods: {
        change_answer(answer) {
            this.selected_value = answer
            emitter.$emit('question' + (this.question.web_id) + '-answer', answer)
        },
        capitalizeFirstLetter(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
    }
}
</script>
