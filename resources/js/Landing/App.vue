<template>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid p-0">
                <a class="navbar-brand ps-3" href="#">
                    <img :src="'/img/logo.webp'">
                </a>
                <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">{{__('Header.Benefits')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{__('Header.How it works')}}</a>
                        </li>
                        <li class="nav-item">
                            <router-link :class="['nav-link',$route.meta.activeName === 'audit' ? 'active' : '']" :to="'/audit/building-types'">{{__('Header.Audit')}}</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{__('Header.Register')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{__('Header.Log In')}}</a>
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
                        <img :src="'/img/logo.webp'">
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="links-footer">
                        <h2>{{__('Header.Quick links')}}</h2>
                        <ul class="list-unstyled p-0">
                            <li><a href="#">{{__('Footer.About the Royal Commission for Riyadh City')}}</a></li>
                            <li><a href="#">{{__('Footer.About Access Riyadh')}}</a></li>
                            <li><a href="#">{{__('Footer.How it works')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="links-footer">
                        <h2>{{__('Footer.Our sites')}}</h2>
                        <ul class="list-unstyled p-0">
                            <li><a href="#">{{__('Footer.Riyadh City')}}</a></li>
                            <li><a href="#">{{__('Footer.Riyadh Metro')}}</a></li>
                            <li><a href="#">{{__('Footer.Arriyadh Environment')}}</a></li>
                            <li><a href="#">{{__('Footer.Riyadh GeoEnv Explorer')}}</a></li>
                            <li><a href="#">{{__('Footer.Riyadh Urban Observatory')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright mt-4 text-end">
                <label>{{__('Footer.All rights reserved')}} <i class="fa-regular fa-copyright"></i></label>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    computed: {
        isLangEnglish() {
            // Access the HTML lang attribute and check if it's "en"
            return document.documentElement.lang === 'en';
        },
        isLangArabic() {
            // Access the HTML lang attribute and check if it's "ar"
            return document.documentElement.lang === 'ar';
        },
    },
    mounted() {

    },
    methods:{
        change_locale(language = 'en'){
            // Set a cookie with the selected locale that expires in 30 days
            document.cookie = `locale=${language}; expires=${new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toUTCString()}; path=/`;
            // Redirect to the current page to apply the selected locale
            window.location.reload();
        }
    }
}
</script>
