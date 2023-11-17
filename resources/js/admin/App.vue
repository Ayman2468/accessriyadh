<template>
    <div class="sidebar open" style="overflow-y: auto">
        <div class="logo-details" style="padding: 20px 0;background: white">
            <a class="logo_name"  style="text-align: center" href="/"><img  :src="'/img/logos/وصول الرياض-07.png'" style="    width: 75%;"></a>
            <a class="min-logo" href="/"><img :src="'/img/logos/وصول الرياض-07.png'" style="width: 50px;"></a>
        </div>
        <ul class="nav-list mt-3">

            <li>
                <router-link to="/admin/UsersIndex" :class="[$route.meta.activeName === 'users' ? 'active' : '']">
                    <i class='my-icon icon-home'></i>
                    <span class="links_name">المستخدمين</span>
                </router-link>
                <span class="tooltip">المستخدمين</span>
            </li>
            <li>
                <router-link to="/admin/home" :class="[$route.meta.activeName === 'home' ? 'active' : '']">
                    <i class='my-icon icon-home'></i>
                    <span class="links_name">أنواع المباني</span>
                </router-link>
                <span class="tooltip">أنواع المباني</span>
            </li>
            <li>
                <router-link to="/admin/questions" :class="[$route.meta.activeName === 'questions' ? 'active' : '']">
                    <i class='my-icon icon-home'></i>
                    <span class="links_name">إدارة الاسئلة</span>
                </router-link>
                <span class="tooltip">إدارة الاسئلة</span>
            </li>
            <li>
                <router-link to="/admin/applications" :class="[$route.meta.activeName === 'applications' ? 'active' : '']">
                    <i class='my-icon icon-home'></i>
                    <span class="links_name">إدارة الطلبات</span>
                </router-link>
                <span class="tooltip">إدارة الطلبات</span>
            </li>

        </ul>
    </div>
    <section class="home-section">
        <header class="header-dashboard d-flex justify-content-between fixed-top">

            <div class="btn-open">
                <a href="javascript:void(0);" id="btn" class="d-block btn-menu-toggle" @click="toggleSideBar"><img
                    :src="'/dashboard/images/btn-menu.svg'"></a>
            </div>

            <div class="links-header">
                <ul>
                    <li class="list-inline-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <span class="centerProfileTitle navbar-username">{{user.name}}</span>

                            <img
                                :class="['rounded-circle','nav-bar-logo',!user.image ? 'd-none' : '']  "
                                :src="user.image_url">

                            <span
                                :class="['badge','rounded-circle','nav-bar-badge','badge-secondary',user.image ? 'd-none' : '']"
                                style="background: rgb(206 109 72);font-size: 24px;vertical-align: middle;font-family: auto;margin-left: 4px;padding: 0.35em 0.55em;">
                        {{(user.name).charAt(0)}}
                    </span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <router-link class="dropdown-item" :to="'/admin/profile'">بيانات حسابي</router-link>
                            </li>
                            <li><a class="dropdown-item" href="/logout"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">تسجيل الخروج</a></li>
                        </ul>

                    </li>

                </ul>
            </div>
        </header>


        <router-view></router-view>

    </section>
    <edit-question></edit-question>
    <edit-question-general></edit-question-general>
    <edit-building-type></edit-building-type>

</template>

<script>
export default {
    data() {
        return {
            user: {
                name:'--'
            }
        }
    },
    mounted() {
        this.get_inital()
    },
    methods:{
        get_inital(){
            this.loading = true;
            axios.get('/admin/user/auth').then((response) => {
                this.loading = false;
                this.user = response.data.user;
            })
        }
    }
}
</script>
