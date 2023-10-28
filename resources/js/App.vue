<template>
    <router-view/>
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
