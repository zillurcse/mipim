<template>
    <div class="container mx-auto bg-white p-0">
        <MainLayoutVue>
            <section class="about-section">
                <div class="container">
                    <div>
                        <ul class="section-link">
                            <li>Home</li>
                            <li>/</li>
                            <li class="active">Categories</li>
                        </ul>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Categorie list:</h3>

                    <div v-if="categoryItems.data.length > 0" class="row">

                        <div class="col-md-4 mb-3" v-for="(category, key) in categoryItems.data" :key="key">

                            <div @click="categoryByContent(category.id)"
                                class="px-3 py-3 shadow-sm border rounded-lg relative h-full flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="#9A5626" class="w-5 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                                <h2 class="text-base text-gray-800 font-medium ">{{ category.name }}</h2>
                            </div>

                        </div>
                        <div>
                            <button @click="prevPage" :disabled="!categoryItems.prev_page_url">Previous</button>
                            <button @click="nextPage" :disabled="!categoryItems.next_page_url">Next</button>
                        </div>
                    </div>
                </div>
            </section>
            <br>

            <div class="py-10" v-if="categoryByContentData">
                <div class="container  data-box-row">

                    <div class="row">
                        <div v-for="(content, index) in categoryByContentData.data" :key="index" class="col-md-4 mb-4 ">
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
                                    <img src="https://newmurabba.com/-/jssmedia/Project/Murabba/murabba-site//images/ico_6x12_angle_right.svg"
                                        alt="image" loading="lazy" class="w-5" />
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


import MainLayoutVue from '../Layouts/MainLayout.vue';
import axios from "axios";
import carousel from "vue-owl-carousel";

export default {
    name: "Category",
    props: {
        categoryItems: Object
    },
    components: {
        MainLayoutVue,
        carousel,
        Link
    },
    data() {
        return {
            categoryByContentData: [],
        }
    },
    async mounted() {

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
                console.log(sliceData);
                return sliceData;

            }
            return details;
        },
        async categoryByContent(id) {
            await axios.get('/api/category-by-content/' + id)
                .then(response => {

                    if (response.status === 200) {
                        this.categoryByContentData = response.data.data

                    }

                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        // this.toastMessage('error', error, 'check', '', 'times')
                        console.error('Error:', error);
                    }
                })
                .finally(() => {

                })
        },
        prevPage() {
            if (this.categoryItems.prev_page_url) {
                this.$inertia.visit(this.categoryItems.prev_page_url);
            }
        },
        nextPage() {
            if (this.categoryItems.next_page_url) {
                this.$inertia.visit(this.categoryItems.next_page_url);
            }
        }
    }
}
</script>

<style scoped>
.about-section {
    padding: 50px 35px;
}

.about-section h3 {
    color: #9A5626;
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
}

.styles-data {
    padding: 24px;
    /* height: 274px; */
    position: relative;

    background: #9A5626;
}

.styles-auto {
    position: relative;
}

.styles-date {
    position: relative;
    font-family: 12px;
    color: #fff;
    margin-bottom: 6px;
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
}

.global-arrow-button {
    position: absolute;
    bottom: 30px;
    left: 28px;
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
