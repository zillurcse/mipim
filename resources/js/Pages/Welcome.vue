<template>
    <div class="container mx-auto bg-white p-0">
        <MainLayoutVue :bannerItems="bannerItems" :contentItems="contentItems">


            <section class="text-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="text-box">
                                <h2>{{ bioItems.title }}</h2>
                                <br />
                                <p>
                                    {{ bioItems.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="py-10">
                <div class="container  data-box-row">
                    <div class="row">
                        <div v-for="(  content, index  ) in  contentItems " :key="index" class="col-md-4 mb-3">
                            <Link :href="'project/' + content.slug" class="styles-item relative">
                            <div class="styles-image">
                                <img :src="content.file" alt="Banner" />
                            </div>
                            <div class="styles-data">
                                <div class="styles-auto">

                                    <div class="styles-title" v-if="content.category">{{ content.category.name
                                        }}
                                    </div>
                                    <div class="styles-title" v-else>No category</div>
                                    <div>
                                        <div class="styles-description" v-html="truncateContent(content.details)">

                                        </div>
                                    </div>
                                </div>
                                <div class="styles-btn-bottom">
                                    <div class="styles_btn-wrap__aQjN0">

                                    </div>
                                </div>

                                <template slot="prev"><span class="prev">prev</span></template>



                                <template slot="next"><span class="next">next</span></template>
                            </div>
                            <div class="global-arrow-button arrow-direction-right d-flex gap-2 align-items-center">
                                <span class="global-arrow-button-text">
                                    Find out more
                                </span>
                                <span class="global-arrow-button-image">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>

                                </span>
                            </div>
                            </Link>
                        </div>
                    </div>



                </div>
            </div>
        </MainLayoutVue>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";
import axios from "axios";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import MainLayoutVue from "../Layouts/MainLayout.vue";
import carousel from "vue-owl-carousel";
import project from "@/Pages/Project.vue";
export default {
    computed: {
        project() {
            return project
        },

    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        bioItems: Object,
        contentItems: Array,
        bannerItems: Array
    },
    components: {
        Link,
        JetResponsiveNavLink,
        MainLayoutVue,
        carousel,
    },
    data() {
        return {
            categoryItems: [],
            modalShow: false,
            popupImg: null,
        };
    },

    async mounted() {
        await this.getCategoryData();
    },
    methods: {
        stripHtml(html) {
            let tmp = document.createElement("DIV");
            tmp.innerHTML = html;
            return tmp.textContent || tmp.innerText || "";
        },
        truncateContent(details) {
            const text = this.stripHtml(details);
            const words = text.split(' ');
            if (words.length > 100) {
                let sliceData = words.slice(0, 100).join(' ') + '...';

                return sliceData;

            }
            return details;
        },
        async getCategoryData() {
            await axios
                .get("/api/web/category")
                .then((response) => {
                    if (response.status === 200) {
                        this.categoryItems = response.data.data.items;
                    }
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        // this.toastMessage('error', error, 'check', '', 'times')
                        console.log(error);
                    }
                })
                .finally(() => { });
        },

        openImagePopUp(img) {
            this.modalShow = true;
            this.popupImg = img;
        },
        hideModal() {
            this.modalShow = false;
            this.popupImg = "";
        },
    },
};
</script>

<style>
.owl-item {
    height: 470px;
}

.owl-theme .owl-dots {
    margin-top: 20px;
}

.show {

    display: block;
}

.modal {
    background-color: rgba(0, 0, 0, 0.432);
}

.modal-body img {
    max-height: 500px;
    object-position: center;
    object-fit: cover;
}

.modal-dialog {
    max-width: 700px;
}

.carousel-item {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.styles-item {
    display: block;
    background-color: #9A5626;
    text-decoration: none;
    height: 100%;
    transition: all .3s ease-in;
    overflow: hidden;
}

.styles-image {
    position: relative;
    width: 100%;
    height: 260px;
    background-color: #fff;
}

.styles-image img {
    position: relative;
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: all .3s ease-in;

}

.styles-data {
    padding: 24px;
    height: 230px;
    position: relative;
    background: #9A5626;
    transition: all .3s ease-in;
}

.styles-auto {
    position: relative;
}

.styles-date {
    position: relative;
    font-family: 12px;
    color: #fff;
    margin-bottom: 6px;
    transition: all .3s ease-in;

}

.styles-title {
    position: relative;
    font-size: 20px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: all .3s ease-in;
    font-family: "Zaha", sans-serif !important;
}

.styles-description {
    position: relative;
    font-size: 16px;
    color: #fff;
    width: 100%;
    height: auto;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 24px;
    transition: all .3s ease-in;

}

.global-arrow-button {
    position: absolute;
    bottom: 24px;
    left: 28px;
}

.global-arrow-button-text {
    transition: color 0.3s ease-in-out;
    position: relative;
    font-size: 16px;
    color: #fff;
}

.global-arrow-button-image {
    color: #fff;
}

.styles-item:hover {
    background: #111;
}

.styles-item:hover .styles-data {
    background: #111;

}

.styles-item:hover .styles-image img {
    transform: scale(1.03);
}

.owl-nav {
    position: absolute;
    right: 0;
    margin: 0;
    bottom: -8px;
}

.owl-prev,
.owl-next {
    position: relative;
    width: 30px;
    /* Adjust according to the size of the icon */
    height: 30px;
    /* Adjust according to the size of the icon */
    text-indent: -9999px;
    /* Hide the text */
    overflow: hidden;
    /* Ensure the text is not visible */
    display: inline-block;
    background-color: transparent !important;
    /* Adjust display as needed */
}

.owl-prev {
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 6.627 5.373 12 12 12 6.627 0 12-5.373 12-12C24 5.373 18.627 0 12 0zm0 21.6c-5.293 0-9.6-4.307-9.6-9.6 0-5.293 4.307-9.6 9.6-9.6 5.293 0 9.6 4.307 9.6 9.6 0 5.293-4.307 9.6-9.6 9.6z"/><path d="M17.657 11.293l-4-4a1 1 0 0 0-1.414 1.414L14.586 11H7a1 1 0 0 0 0 2h7.586l-2.343 2.293a1 1 0 1 0 1.414 1.414l4-4a1 1 0 0 0 0-1.414z"/></svg>') !important;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}

.owl-next {
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 6.627 5.373 12 12 12 6.627 0 12-5.373 12-12C24 5.373 18.627 0 12 0zm0 21.6c-5.293 0-9.6-4.307-9.6-9.6 0-5.293 4.307-9.6 9.6-9.6 5.293 0 9.6 4.307 9.6 9.6 0 5.293-4.307 9.6-9.6 9.6z"/><path d="M8.343 11.293l4-4a1 1 0 1 1 1.414 1.414L9.414 11H17a1 1 0 0 1 0 2H9.414l2.343 2.293a1 1 0 0 1-1.414 1.414l-4-4a1 1 0 0 1 0-1.414z"/></svg>') !important;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}

@media (max-width: 450px) {
    .owl-nav {
        bottom: -42px;
        transform: translateX(-50%);
        left: 50%;
    }

    .owl-carousel .owl-stage-outer {
        margin-bottom: 20px;
    }
}
</style>
