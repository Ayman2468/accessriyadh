import BuildingTypes from "./Landing/Audit/BuildingTypes.vue";
import RegisterInfo from "./Landing/Audit/RegisterInfo.vue";
import Step from "./Landing/Audit/Step.vue";
import Completed from "./Landing/Audit/Completed.vue";

import Home from "./admin/Home.vue";
import User from "./admin/User/Index.vue";
import BuildingType from "./admin/BuildingType/Index.vue";
import ApplicationIndex from "./admin/Application/Index.vue";
import ApplicationShow from "./admin/Application/Show.vue";
import Question from "./admin/BuildingType/Question/Index.vue";
import EditAccountSetting from "./admin/AccountSetting/Edit.vue";
import QuestionGeneral from "./admin/Question/Index.vue";
import DefaultLayout from "./Landing/App.vue";
import AdminLayout from "./admin/App.vue";

export const routes = [
    {
        path:'/',
        name:'Public',
        component:DefaultLayout,
        redirect: '/',
        children:[
            {
                name: 'home',
                meta:{
                    activeName: 'audit',
                },
                path: '/',
                component: BuildingTypes
            },
            {
                name: 'building-types',
                meta:{
                    activeName: 'audit',
                },
                path: '/audit/building-types',
                component: BuildingTypes
            },
            {
                name: 'register-info',
                meta:{
                    activeName: 'audit',
                },
                path: '/audit/building-types/:type/register-info',
                component: RegisterInfo
            },
            {
                name: 'step-1',
                meta:{
                    activeName: 'audit',
                },
                path: '/audit/building-types/:type/step/:step',
                component: Step
            },
            {
                name: 'completed',
                meta:{
                    activeName: 'audit',
                },
                path: '/audit/completed',
                component: Completed
            },
        ]
    },

    {
        path:'/',
        name:'Admin',
        component:AdminLayout,
        redirect: '/',
        children:[
            {
                path: '/admin/home', component: BuildingType, meta: {
                    breadcrumb: 'Home',
                    meta: { requiresAuth: false, requiresRole: 'super-admin' },
                    activeName: 'home'
                }
            },
            {
                path: '/admin/home', component: BuildingType, meta: {
                    breadcrumb: 'Home',
                    meta: { requiresAuth: false, requiresRole: 'super-admin' },
                    activeName: 'home'
                }
            },
            {
                path: '/admin/building-types/:id/questions', component: Question, meta: {
                    breadcrumb: 'Question',
                    meta: { requiresAuth: false, requiresRole: 'super-admin' },
                    activeName: 'Question'
                }
            },
            {
                path: '/admin/applications', component: ApplicationIndex, meta: {
                    breadcrumb: 'ApplicationIndex',
                    meta: { requiresAuth: false, requiresRole: 'super-admin' },
                    activeName: 'applications'
                }
            },
            {
                path: '/admin/applications/:id', component: ApplicationShow, meta: {
                    breadcrumb: 'ApplicationShow',
                    meta: { requiresAuth: false, requiresRole: 'super-admin' },
                    activeName: 'applications'
                }
            },
            {
                path: '/admin/questions', component: QuestionGeneral, meta: {
                    breadcrumb: 'QuestionGeneral',
                    meta: { requiresAuth: false, requiresRole: 'super-admin' },
                    activeName: 'QuestionGeneral'
                }
            },

            {
                path: '/admin/profile', component: EditAccountSetting, meta: {
                    breadcrumb: 'EditAccountSetting',
                    meta: { requiresAuth: true, requiresRole: 'super-admin' },
                    activeName: 'EditAccountSetting'
                }
            },

            {
                path: '/admin/users', component: User, name: "UserIndex", meta: {
                    breadcrumb: 'User',
                    meta: { requiresAuth: true, requiresRole: 'super-admin' },
                    activeName: 'users',
                    activeNameSub: 'users'

                }
            },
        ]
    },

];
