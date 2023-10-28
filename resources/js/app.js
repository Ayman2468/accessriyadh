import './bootstrap';
import {createApp,ref, computed} from 'vue'

import { createRouter, createWebHistory } from 'vue-router'

import axios from 'axios';
import App from './App.vue'
import {routes} from './routes';
import * as pagination from 'laravel-vue-pagination';
import * as Multiselect from 'vue-multiselect'
import EditQuestion from "./admin/BuildingType/Question/Edit.vue";
import EditQuestionGeneral from "./admin/Question/Edit.vue";
import EditBuildingType from "./admin/BuildingType/Edit.vue";
import ContentLoader from "./admin/ContentLoader.vue";
const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

const app = createApp(App)
// start for local and translations
const i18n = ref(window.i18n);
app.config.globalProperties.__ = (str) => {
    const keys = str.split('.');
    let value = i18n.value;
    for (const key of keys) {
        if (!value[key]) {
            return '';
        }
        value = value[key];
    }
    return value;
};
// end for local and translations
app.use(router)
app.component('multiselect', Multiselect)
app.component('edit-question',EditQuestion)
app.component('edit-question-general',EditQuestionGeneral)
app.component('edit-building-type',EditBuildingType)
app.component('ContentLoader',ContentLoader)
app.component('axios',axios)
app.component('pagination',pagination)
app.mount('#app')
