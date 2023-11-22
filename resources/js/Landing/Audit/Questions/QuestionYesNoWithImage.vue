<template>
    <div class="form-block form-block-inner mt-3" v-if="question" :id="'web-id-'+question.web_id">
        <div class="row " >
            <div class="col-md-12 mb-2">
                <label class="form-label d-block text-center">
                    {{ question.name }}
                    <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true"
                       :data-bs-title="question.description" class="fa-solid fa-circle-question"></i>
                </label>
            </div>
            <div v-for="(answer,index) in question.answers_array"
                 :class="[index == 0 ? 'offset-md-3' : '','col-md-3','col-sm-6','col-6']" :id="'web-id-'+question.web_id">
                <div
                    :class="['input-building',selected_value == answer['en'] ? 'checked' : '']">
                    <label class="text-center position-relative">
                        <input type="radio" name="building"
                               @change="change_answer(answer['en'])">
                        <img :src="[answer['image']]">
                        <span>{{ capitalizeFirstLetter(answer[question.locale]) }}</span>
                        <i class="fa-solid fa-circle-check"></i>
                    </label>
                </div>
            </div>
<!--            <div class="col-md-3 col-sm-6 col-6">-->
<!--                <div-->
<!--                    :class="['input-building',selected_value == Object.keys(question.answers_array)[1] ? 'checked' : '']">-->
<!--                    <label class="text-center position-relative">-->
<!--                        <input type="radio" name="building"-->
<!--                               @change="change_answer(Object.keys(question.answers_array)[1])">-->
<!--                        <img :src="question.answers_array[Object.keys(question.answers_array)[1]]">-->
<!--                        <span>{{ capitalizeFirstLetter(Object.keys(question.answers_array)[1]) }}</span>-->
<!--                        <i class="fa-solid fa-circle-check"></i>-->
<!--                    </label>-->
<!--                </div>-->
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
            selected_value: '',
        }
    },
    async mounted() {
        try {
            if (this.question.application_answer){
                this.selected_value = this.question.application_answer.answer
                this.change_answer(this.selected_value)
            }
        } catch(e) {
            console.log(e.message);
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
