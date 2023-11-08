import BuildingTypes from "./Landing/Audit/BuildingTypes.vue";
import RegisterInfo from "./Landing/Audit/RegisterInfo.vue";
import Step from "./Landing/Audit/Step.vue";
import Completed from "./Landing/Audit/Completed.vue";
import Benefits from "./Landing/Benefits.vue";
import HowItWorks from "./Landing/HowItWorks.vue";
import Learn from "./Landing/Learn.vue";
import Welcome from "./Landing/Home.vue";

import Home from "./admin/Home.vue";
import users from "./admin/User/Index.vue";
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
                component: Welcome
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
            {
                name: 'benefits',
                meta:{
                    activeName: 'audit',
                },
                path: '/benefits',
                component: Benefits
            },
            {
                name: 'how it works',
                meta:{
                    activeName: 'audit',
                },
                path: '/how-it-works',
                component: HowItWorks
            },
            {
                name: 'learn',
                meta:{
                    activeName: 'audit',
                },
                path: '/learn',
                component: Learn
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
                path: '/admin/UsersIndex', component: users,name:"UserIndex", meta: {
                    breadcrumb: 'users',
                    meta: { requiresAuth: true, requiresRole: 'super-admin' },
                    activeName: 'users',
                    activeNameSub: 'users'

                }
            },
        ]
    },

];
