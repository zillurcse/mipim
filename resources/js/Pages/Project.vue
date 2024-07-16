<template>
    <div class="container mx-auto bg-white p-0">
        <MainLayoutVue :bannerItems="bannerItems">
            <section class="about-section">
                <div class="container">
                    <div>
                        <ul class="section-link">
                            <li>Home</li>
                            <li>/</li>
                            <li class="active">{{ content.slug }}</li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="about-deatiles col-lg-8">
                            <p v-html="content.details" v-if="content.details">

                            </p>
                            <p v-else class="p-2">
                                No details found
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="box-wrapper">
                                <div class="info-box" v-if="content.get_in_touch">
                                    <h3>Get in touch</h3>
                                    <div class="d-flex gap-2 align-items-center mb-2 ">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" width="16" class="size-6">
                                                <path fill-rule="evenodd"
                                                    d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <span v-if="content.get_in_touch.phone"> {{ content.get_in_touch.phone }} </span>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center ">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                            </svg>

                                        </div>
                                        <span v-if="content.get_in_touch.email">{{ content.get_in_touch.email }}</span>
                                    </div>
                                </div>
                                <div class="boucher-box" v-if="content.boucher_files">
                                    <h3>Boucher <span>({{ boucherFilesLength }})</span></h3>

                                    <div class="d-flex justify-between align-items-center py-3" v-for="(url, key) in content.boucher_files" :key="key">
                                        <div class="d-flex align-items-center gap-3">
                                            <svg width="18" height="23" viewBox="0 0 18 23" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_217_24)">
                                                    <path
                                                        d="M17.8218 4.95911L12.8317 0.171004C12.7426 0.0855019 12.6535 0 12.4752 0H1.9604C0.891089 0 0 0.855019 0 1.88104V21.0335C0 22.0595 0.891089 22.9145 1.9604 22.9145H15.9505C17.0198 22.9145 17.9109 22.0595 17.9109 21.0335V5.30112C18 5.13011 17.9109 5.04461 17.8218 4.95911ZM13.0099 1.62454L16.3069 4.7881H13.9901C13.4554 4.7881 13.0099 4.36059 13.0099 3.84758V1.62454ZM17.0198 21.119C17.0198 21.632 16.5743 22.0595 16.0396 22.0595H1.9604C1.42574 22.0595 0.980198 21.632 0.980198 21.119V1.88104C0.980198 1.36803 1.42574 0.94052 1.9604 0.94052H11.9406V3.84758C11.9406 4.87361 12.8317 5.72862 13.901 5.72862H16.9307V21.119H17.0198Z"
                                                        fill="#9a5626" />
                                                    <path
                                                        d="M11.495 14.1078C11.0495 13.7658 10.6039 13.4238 10.3366 13.0818C9.98015 12.7398 9.62372 12.3978 9.35639 12.0558C9.80194 10.6878 9.98015 10.0037 9.98015 9.57623C9.98015 7.9517 9.35639 7.69519 8.4653 7.69519C7.75243 7.69519 6.95045 8.0372 6.95045 9.66173C6.95045 10.3457 7.396 11.2863 8.19798 12.2268C8.01976 12.8253 7.75243 13.5093 7.4851 14.1933C7.39599 14.5353 7.21778 14.8773 7.03956 15.2194C6.95045 15.3049 6.77223 15.3049 6.68312 15.3904C6.32669 15.5614 5.88114 15.7324 5.52471 15.9034C3.92075 16.5874 2.85144 17.1004 2.85144 18.0409C2.85144 18.7249 3.65342 19.1524 4.36629 19.1524C5.25738 19.1524 6.68312 17.9554 7.75243 15.9889C8.82174 15.5614 10.1584 15.3049 11.1386 15.1339C11.9405 15.7324 12.9207 16.3309 13.3663 16.3309C14.6138 16.3309 14.8811 15.6469 14.8811 15.0484C14.8811 13.9368 13.5445 13.9368 12.9207 13.9368C12.7425 13.9368 12.2079 13.9368 11.495 14.1078ZM4.4554 18.2119C4.18807 18.2119 4.00986 18.0409 3.92075 18.0409C3.92075 17.6989 4.99005 17.1859 5.97025 16.7584C6.05936 16.7584 6.05936 16.6729 6.14847 16.6729C5.52471 17.6989 4.81184 18.2119 4.4554 18.2119ZM8.01976 9.66173C8.01976 8.63571 8.37619 8.63571 8.55441 8.63571C8.91085 8.63571 9.08906 8.63571 9.08906 9.57623C9.08906 9.74723 8.91085 10.2602 8.73263 11.1153C8.19798 10.5168 8.01976 10.0037 8.01976 9.66173ZM8.37619 14.7918C8.37619 14.7063 8.4653 14.6208 8.4653 14.5353C8.64352 14.0223 8.82174 13.5093 8.99996 13.0818C9.17817 13.3383 9.4455 13.5093 9.71283 13.7658C9.80194 13.8513 10.0693 14.0223 10.3366 14.2788C9.62372 14.4498 8.99996 14.6208 8.37619 14.7918ZM13.9901 15.0484C13.9901 15.3049 13.9901 15.3904 13.5445 15.3904C13.3663 15.3904 13.099 15.2194 12.7425 14.9628C12.9207 14.9628 13.0099 14.9628 13.0099 14.9628C13.7227 14.8773 13.9009 14.9628 13.9901 15.0484Z"
                                                        fill="#9a5626" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_217_24">
                                                        <rect width="18" height="23" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                            <div class="d-flex flex-col boucher-text uppercase">
                                                <p>{{ truncateFileName(removeFileExtension(key)) }}</p>
                                                <span>{{  getFileType(key) }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 align-items-center">

                                            <a :href="url" target="_blank">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="#9a5626"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_220_19)">
                                                        <path
                                                            d="M8.97534 16.8658C13.3151 16.8658 16.8164 13.3644 16.8164 8.97534C16.8164 4.5863 13.3151 1.08493 8.97534 1.08493C4.63562 1.08493 1.13425 4.5863 1.13425 8.97534C1.13425 13.3644 4.63562 16.8658 8.97534 16.8658ZM8.97534 0C13.9562 0 17.9507 4.04384 17.9507 8.97534C17.9507 13.9562 13.9068 17.9507 8.97534 17.9507C4.04384 18 0 13.9562 0 8.97534C0 4.04384 4.04384 0 8.97534 0Z"
                                                            fill="#9a5626" />
                                                        <path
                                                            d="M8.43276 13.2658V2.81097H9.567V13.2658L12.5259 10.3069L13.3149 11.0959L9.36974 15.0411C9.17248 15.2384 8.77796 15.2384 8.5807 15.0411L4.6355 11.0959L5.42454 10.3069L8.43276 13.2658Z"
                                                            fill="#9a5626" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_220_19">
                                                            <rect width="18" height="18" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>

                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </MainLayoutVue>
    </div>


</template>

<script>

import MainLayoutVue from '../Layouts/MainLayout.vue';
import axios from "axios";

export default {
    name: "Project",
    props: {
        content: Object,
        bannerItems: Array,
    },
    components: {
        MainLayoutVue
    },
    computed: {
        boucherFilesLength() {
            return Object.keys(this.content.boucher_files).length;
        }
    },
    data() {
        return {
            // categoryItems: [],
        }
    },
    mounted() {
    },

    methods: {
        removeFileExtension(fileName) {
            if (fileName && typeof fileName ==='string'){
                return fileName.replace(/\.[^/.]+$/, "");
            }
        },

        truncateFileName(fileName) {
            if (fileName){
                const maxLength = 45;
                if (fileName.length > maxLength) {
                    return fileName.substring(0, maxLength) + "...";
                }
                return fileName;
            }
        },

        getFileType(fileName) {
            if (fileName && typeof fileName ==='string'){
                const extension = fileName.split('.').pop();
                return extension.toUpperCase() + " FILE";
            }
        }
    }
}
</script>

<style scoped>
.about-section {
    padding: 50px 35px;
}
</style>
