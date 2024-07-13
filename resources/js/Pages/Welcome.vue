<template>
    <div class="container mx-auto bg-white p-0">
        <MainLayoutVue :bannerItems="bannerItems">


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
                    <carousel :autoplay="true" :nav="false">
                        <div v-for="(content, index) in contentItems" :key="index">
                            <Link :href="'project/'+content.slug" class="styles_item__yc34S">
                                <div class="styles_image__ioRlD">
                                    <img :src="content.file"
                                         alt="Banner" />
                                </div>
                                <div class="styles_data__p2rYX">
                                    <div class="styles_auto__1qfe4">
                                        <div class="styles_date___IRmP">
                                            <span>{{ content.created}}</span>
                                        </div>
                                        <div class="styles_title__mDgkM" v-if="content.category">{{ content.category.name }}</div>
                                        <div class="styles_title__mDgkM" v-else>No category</div>
                                        <div>
                                            <div class="styles_description__fbukA">
                                                Riyadh, Saudi Arabia – 31 May 2024 – New Murabba Development
                                                Company, owned by the Public Investment Fund, recently
                                                hosted the anticipated New Murabba Partnership forum at the
                                                Intercontinental Durrat Al Riyadh on May 28-29. This
                                                landmark event convened a diverse group of vendors and
                                                partners to explore the vast opportunities within this
                                                groundbreaking destination, set to become the most
                                                transformative downtown in Riyadh.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="styles_btn-bottom__LKLzJ">
                                        <div class="styles_btn-wrap__aQjN0">
                                            <div
                                                class="global-arrow-button arrow-direction-right d-flex gap-2 align-items-center">
                                            <span class="global-arrow-button-text">
                                                Find out more
                                            </span>
                                                <span class="global-arrow-button-image">
                                                <img src="https://newmurabba.com/-/jssmedia/Project/Murabba/murabba-site//images/ico_6x12_angle_right.svg"
                                                     alt="image" loading="lazy" class="w-5" />
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </Link>
                        </div>
                    </carousel>
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
        }
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

<style scoped>
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

.styles_item__yc34S {
    box-shadow: 4px 4px 14px -10px rgba(0, 0, 0, 0.05);
    display: block;
    border: 1px solid transparent;
    text-decoration: none;
}

.styles_item__yc34S .styles_image__ioRlD {
    position: relative;
    width: 100%;
    height: 260px;
}

.styles_item__yc34S .styles_image__ioRlD img {
    position: relative;
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.styles_item__yc34S .styles_data__p2rYX {
    padding: 24px;
    /* height: 274px; */
    position: relative;

    background: #111;
}

.styles_latestNews__xmi_D .styles_auto__1qfe4 {
    position: relative;
}

.styles_item__yc34S .styles_data__p2rYX .styles_date___IRmP {
    position: relative;
    font-family: 12px;
    color: #f7f3eb;
    margin-bottom: 6px;
}

.styles_item__yc34S .styles_data__p2rYX .styles_title__mDgkM {
    position: relative;
    font-size: 20px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.styles_item__yc34S .styles_data__p2rYX .styles_description__fbukA {
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
}

.global-arrow-button-text {
    transition: color 0.3s ease-in-out;
    position: relative;
    font-size: 16px;
    color: #fff;
}

.global-arrow-button-image img {
    width: 16px !important;
}
</style>
