<template>
    <div class="banner">
        <img
            id="img1"
            class="active"
            src="../../../public/img/banners/Access-Riyadh-landing-banners4-02.png"
            alt="Image 1"
        />
        <img
            id="img2"
            src="../../../public/img/banners/Access-Riyadh-landing-banners5-02.png"
            alt="Image 2"
        />
        <img
            id="img3"
            src="../../../public/img/banners/Access-Riyadh-web-landing-banners-02.png"
            alt="Image 3"
        />
        <img
            id="img4"
            src="../../../public/img/banners/Access-Riyadh-landing-banners3-02.png"
            alt="Image 4"
        />
    </div>
    <div class="welcome d-flex">
        <p class="col-10 col-md-6 col-lg-5 backgroundGreen text-white h4 text-center py-2">{{ __('pages.Welcome to Access Riyadh') }}</p>
        <p class="welomeAfter"></p>
    </div>
    <div class="container d-flex flex-column flex-column-reverse flex-lg-row justify-content-around mb-5">
        <div class="col-12 col-lg-3">
            <p>{{ __('pages.welcome_content') }}</p>
            <p>{{ __('pages.welcome_content2') }}</p>
            <a href="/audit/building-types" class="btn rounded-0 backgroundGreen text-white"><span class="mx-5">{{ __('pages.welcome_button') }}</span><i class="far fa-arrow-alt-circle-right"></i></a>
        </div>
        <div class="col-12 col-lg-7 text-center vh-50 mb-3">
            <iframe class="w-100 h-100" src="https://www.youtube.com/embed/E3Q70XNnlno?si=AEYsOf-QscEGjju4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    data() {
        return {
            j: 0,
        };
    },
    async mounted() {
        var images = document.querySelectorAll('[id^="img"]');
        var imgList = [];
        for (var i = 0; i < images.length; i++) {
            imgList.push(images[i]);
        }
        setInterval(() => {
            if(this.j == 0) this.j = 1;
            if (this.j == 4) this.j = 0;
            imgList.forEach((im, index) => {
                if (index != this.j) {
                    im.classList.remove("active");
                    im.classList.add("d-none");
                }
            });
            if (this.j == 0) imgList[this.j].classList.remove("d-none");
            if (this.j != 3) imgList[this.j + 1].classList.remove("d-none");
            imgList[this.j].classList.add("active");
            this.j++;
        }, 4000);
    },
    methods: {},
};
</script>
<style>
body,
html {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
}

.banner {
    display: flex;
    width: 400%;
    height: 100%;
}

.banner img {
    width: 25%;
    height: 100%;
    object-fit: cover;
    z-index: -100;
    opacity: 0;
}

.banner img.active {
    opacity: 1;
    transform: scale(1.2);
    position: relative;
    bottom: 35px;
    right: 35px;
    transition: 4s;
}
.backgroundGreen{
    background: #00874e;
}
.welcome{
    height: 60px;
    background-color: transparent;
    position: relative;
    bottom: 45px;
}
.vh-50{
    height: 50vh;
}
</style>
