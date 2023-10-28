<template>
    <div class="form-block form-block-inner mt-3" v-if="question" :id="'web-id-'+(question.web_id)">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-2">
                <label class="form-label d-block text-center">
                    {{ question.name }}
                    <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" :data-bs-title="question.description" class="fa-solid fa-circle-question"></i>
                </label>
            </div>
            <div class="col-lg-3 col-md-6 col-6" v-for="(answer,index) in question.answers_array">
                <div :class="['input-building',selectedCheckboxes.includes(answer['en']) ? 'checked' : '']">
                    <label class="text-center position-relative">
                        <input type="checkbox" name="building[]" v-model="selectedCheckboxes" :value="answer['en']" @change="change_answer">
                        <img :src="answer['image']">
                        <span>{{ answer[question.locale] }}</span>
                        <i class="fa-solid fa-circle-check"></i>
                    </label>
                </div>
            </div>
        </div>
    </div>
 </template>

<script>
import emitter from "../../../emitter";

export default {
    props:{
        question:null
    },
    components: {},
    data() {
        return {
            selectedCheckboxes: []
        }
    },
    async mounted() {
        if (this.question.application_answer){
            this.selectedCheckboxes = this.question.application_answer.answer.split(',').map(function(item) {
                return item.trim();
            });
            this.change_answer()
        }
    },
    methods: {
        change_answer(){
            console.log(this.selectedCheckboxes,'this.selectedCheckboxes')
            emitter.$emit('question'+(this.question.web_id)+'-answer',this.selectedCheckboxes)
        }
    }
}
</script>
