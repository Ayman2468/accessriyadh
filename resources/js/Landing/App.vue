<template>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid p-0 bg-white">
                <a class="navbar-brand ps-3" href="/">
                    <img :src="'/img/logos/وصول الرياض-07.png'">
                </a>
                <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">
                        <div class="col-9 d-md-flex">
                            <li class="nav-item">
                                <router-link class="nav-link" aria-current="page" to="/benefits">{{__('Header.About')}}</router-link>
                                <!-- <a class="nav-link" aria-current="page" href="/benefits">{{__('Header.Benefits')}}</a> -->
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" aria-current="page" to="/how-it-works">{{__('Header.How it works')}}</router-link>
                            </li>
                            <!-- <li class="nav-item">
                                <router-link class="nav-link" aria-current="page" to="/learn">{{__('Header.Learn')}}</router-link>
                            </li> -->
                            <li class="nav-item d-flex col-4">
                                <router-link :class="['nav-link','mx-1']" :to="'/audit/building-types'">{{__('Header.Audit')}}</router-link>
                                <!-- ,$route.meta.activeName === 'audit' ? 'active' : '' -->
                                <div v-if="isLogged && found" class="alert alert-light text-center px-1 py-0 m-0 d-flex align-items-center">
                                    <span v-if="isLangArabic" class="col-1">&#8594</span>
                                    <span v-if="isLangEnglish" class="col-1">&#8592</span>
                                    <p class="col-11" style="font-size: 12px;margin: 0 2px;">{{ __('Header.You have an incomplete application') }}</p>
                                </div>
                            </li>
                            <li class="nav-item" v-if="isLogged">
                                <router-link :class="['nav-link']" :to="'/audit/review'">{{__('Header.Review Applications')}}</router-link>
                                <!-- ,$route.meta.activeName === 'audit' ? 'active' : '' -->
                            </li>
                        </div>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">{{__('Header.Register')}}</a>
                        </li> -->
                        <div class="col-3 d-md-flex">
                            <li class="nav-item" v-if="!isLogged">
                                <a class="nav-link" href="/login?user=userLogin">{{__('Header.Log In')}}</a>
                            </li>
                            <li class="nav-item" v-if="isLogged">
                                <a class="nav-link" href="/logout" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">{{__('Header.Log Out')}}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                   <span v-if="isLangEnglish">English</span>
                                   <span v-else-if="isLangArabic">العربية</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/locale/en">English</a></li>
                                    <li><a class="dropdown-item" href="/locale/ar">العربية</a></li>
                                </ul>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <router-view></router-view>
    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-4 d-flex align-items-center">
                    <a class="footer-brand" href="#">
                        <img :src="'/img/logos/وصول الرياض-07.png'">
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="links-footer">
                        <h2>{{__('Header.Quick links')}}</h2>
                        <ul class="list-unstyled p-0">
                            <li><a href="https://www.rcrc.gov.sa/en/about-us">{{__('Footer.About the Royal Commission for Riyadh City')}}</a></li>
                            <li><a href="/benefits">{{__('Footer.About Access Riyadh')}}</a></li>
                            <li><a href="/how-it-works">{{__('Footer.How it works')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="links-footer">
                        <h2>{{__('Footer.Our sites')}}</h2>
                        <ul class="list-unstyled p-0">
                            <li><a href="https://riyadh.sa/en/">{{__('Footer.Riyadh City')}}</a></li>
                            <li><a href="http://riyadhmetro.sa/en/">{{__('Footer.Riyadh Metro')}}</a></li>
                            <li><a href="https://www.riyadhenv.gov.sa/en/">{{__('Footer.Arriyadh Environment')}}</a></li>
                            <li><a href="http://www.ruo.gov.sa/">{{__('Footer.Riyadh Urban Observatory')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright mt-4 text-end">
                <label>{{__('Footer.All rights reserved')}} <i class="fa-regular fa-copyright"></i></label>
            </div>
        </div>
    </footer>
    <a @click="scrollToTop()" id="scroll" class="text-decoration-none fw-bold text-light bg-secondary rounded-circle">
        <i class="fa fa-angle-up"></i>
    </a>
</template>

<script>
import { Transition } from 'vue';

export default {
    data() {
        return{
            found:false,
        }
    },
    computed: {
        isLangEnglish() {
            // Access the HTML lang attribute and check if it's "en"
            return document.documentElement.lang === 'en';
        },
        isLangArabic() {
            // Access the HTML lang attribute and check if it's "ar"
            return document.documentElement.lang === 'ar';
        },
        isLogged() {
            // check if user is not logged in
            return window.sessionStorage.getItem('user');
        },
    },
    mounted() {
        if(document.documentElement.lang == 'ar'){
            document.getElementById('scroll').classList.add('scroll-top-button-rtl');
        }else{
            document.getElementById('scroll').classList.add('scroll-top-button');
        }
        window.addEventListener("scroll", this.checkScrollPosition);
        this.get_uncomplete();
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.checkScrollPosition);
    },
    methods:{
        change_locale(language = 'en'){
            // Set a cookie with the selected locale that expires in 30 days
            document.cookie = `locale=${language}; expires=${new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toUTCString()}; path=/`;

            // Redirect to the current page to apply the selected locale
            window.location.reload();
        },
        get_uncomplete() {
            axios.get('/landing/audit/application').then((response) => {
                this.loading = false;
                if(Object.keys(response.data).length > 0) this.found = true;
            })
        },
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        },
        checkScrollPosition() {
            if(window.scrollY < 100){
                document.getElementById('scroll').style="cursor: init;";
                document.getElementById('scroll').classList.remove('fade-out');
                document.getElementById('scroll').classList.add('fade-in');
            }else{
                document.getElementById('scroll').style="cursor: pointer;";
                document.getElementById('scroll').classList.remove('fade-in');
                document.getElementById('scroll').classList.add('fade-out');
            }
        },
    }
}
</script>
