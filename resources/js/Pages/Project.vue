<template>
    <div class="container mx-auto bg-white p-0">
        <MainLayoutVue :bannerItems="bannerItems" :contentItems="contentItems">
            <section class="about-section">
                <div class="container">
                    <div>
                        <ul class="section-link">
                            <li>Home</li>
                            <li>/</li>
                            <li class="active">{{ content.title }}</li>
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
                            <div class="box-wrapper" v-if="content.get_in_touch || content.boucher_files">
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
                                        <span style="color: #9A5626" v-if="content.get_in_touch.phone"> {{
            content.get_in_touch.phone }}
                                        </span>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center mb-2">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                            </svg>

                                        </div>
                                        <span style="color: #9A5626" v-if="content.get_in_touch.email">{{
            content.get_in_touch.email }}</span>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center mb-2" v-if="socialLinks.facebook">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 10.904 20.72">
                                                <path id="icons8-facebook-f"
                                                    d="M17.9,9.252H14.252V7.18c0-1.069.087-1.743,1.619-1.743h1.935V2.143A27,27,0,0,0,14.97,2a4.532,4.532,0,0,0-4.862,4.868V9.252H7V13.4h3.108V22.72h4.144V13.393h3.176Z"
                                                    transform="translate(-7 -2)" fill="#fff" />
                                            </svg>
                                        </div>
                                        <a target="_blank" style="color: #9A5626; text-decoration: none"
                                            :href="socialLinks.facebook">{{ facebookLastSegment }}</a>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center mb-2" v-if="socialLinks.twitter">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 19.692 16">
                                                <path id="Twitter"
                                                    d="M19.692,1.894a8.1,8.1,0,0,1-2.32.637A4.052,4.052,0,0,0,19.148.3a8.074,8.074,0,0,1-2.566.98A4.042,4.042,0,0,0,9.592,4.039,4.085,4.085,0,0,0,9.7,4.96,11.469,11.469,0,0,1,1.372.739a4.043,4.043,0,0,0,1.25,5.392A4.007,4.007,0,0,1,.792,5.627v.051a4.041,4.041,0,0,0,3.24,3.96,4.034,4.034,0,0,1-1.065.142,3.974,3.974,0,0,1-.76-.073,4.046,4.046,0,0,0,3.774,2.806A8.116,8.116,0,0,1,.964,14.241,8.143,8.143,0,0,1,0,14.185,11.433,11.433,0,0,0,6.193,16,11.415,11.415,0,0,0,17.688,4.508c0-.176,0-.349-.012-.522a8.211,8.211,0,0,0,2.016-2.09Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <a target="_blank" style="color: #9A5626; text-decoration: none"
                                            :href="socialLinks.twitter">{{ twitterLastSegment }}</a>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center mb-2" v-if="socialLinks.linkedin">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 19.778 20.72">

                                                <path id="icons8-linkedin-2"
                                                    d="M10.638,24.72h-4.3V10.886h4.3ZM8.487,9a2.5,2.5,0,1,1,2.488-2.512A2.508,2.508,0,0,1,8.487,9ZM25.773,24.72H21.487V17.986c0-1.6-.032-3.663-2.233-3.663-2.233,0-2.37,1.743-2.37,3.548V24.72H12.593V10.886h4.12v1.887h.06a4.129,4.129,0,0,1,3.859-2.18c4.347,0,5.147,2.809,5.147,6.528v7.6Z"
                                                    transform="translate(-6 -4)" fill="#fff" />

                                            </svg>
                                        </div>
                                        <a target="_blank" style="color: #9A5626; text-decoration: none"
                                            :href="socialLinks.linkedin">{{ linkedinLastSegment }}</a>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center mb-2" v-if="socialLinks.instagram">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 20 20">
                                                <path id="Instagram"
                                                    d="M14.042,20H5.958A5.965,5.965,0,0,1,0,14.042V5.958A5.965,5.965,0,0,1,5.958,0h8.084A5.965,5.965,0,0,1,20,5.958v8.084A5.965,5.965,0,0,1,14.042,20ZM5.958,2.012A3.951,3.951,0,0,0,2.012,5.958v8.084a3.95,3.95,0,0,0,3.946,3.946h8.084a3.95,3.95,0,0,0,3.946-3.946V5.958a3.95,3.95,0,0,0-3.946-3.946ZM10,15.172A5.172,5.172,0,1,1,15.173,10,5.172,5.172,0,0,1,10,15.172Zm0-8.334A3.161,3.161,0,1,0,13.159,10,3.161,3.161,0,0,0,10,6.838ZM15.181,6.1a1.24,1.24,0,1,1,1.24-1.239A1.24,1.24,0,0,1,15.181,6.1Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <a target="_blank" style="color: #9A5626; text-decoration: none"
                                            :href="socialLinks.instagram">{{ instagramLastSegment }}</a>
                                    </div>
                                </div>
                                <div class="boucher-box" v-if="content.boucher_files">
                                    <h3>Related Documents <span>({{ boucherFilesLength }})</span></h3>

                                    <div class="d-flex justify-between align-items-center py-3"
                                        v-for="(url, key) in content.boucher_files" :key="key">
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
                                                <span>{{ getFileType(key) }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 align-items-center">

                                            <a :href="url" target="_blank">
                                                <img src="/assets/view.svg" alt="" style="height: 30px">

                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-between align-items-center py-3"
                                        v-for="(video, i) in videos" :key="i">
                                        <div class="d-flex align-items-center gap-3">
                                            <svg data-v-dc917932="" width="28" height="28" viewBox="0 0 85 85"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path data-v-dc917932=""
                                                    d="M37.4168 34.3579L50.6757 42.5L37.4168 50.6477V34.3579Z"
                                                    fill="#996B4B"></path>
                                                <path data-v-dc917932=""
                                                    d="M42.5 0C34.0943 0 25.8774 2.49258 18.8883 7.16254C11.8992 11.8325 6.45186 18.4701 3.23514 26.2359C0.0184145 34.0018 -0.823227 42.5471 0.816645 50.7913C2.45652 59.0355 6.50425 66.6083 12.448 72.552C18.3917 78.4958 25.9645 82.5435 34.2087 84.1834C42.4529 85.8232 50.9982 84.9816 58.764 81.7649C66.5299 78.5481 73.1675 73.1008 77.8375 66.1117C82.5074 59.1226 85 50.9057 85 42.5C85 31.2283 80.5223 20.4183 72.552 12.448C64.5817 4.47766 53.7717 0 42.5 0ZM62.7546 52.728C61.9046 55.3395 59.0918 56.9276 56.5026 57.2911C47.1938 58.2809 37.8062 58.2809 28.4974 57.2911C25.9082 56.9276 23.0954 55.3395 22.2454 52.728C20.9201 45.9756 20.9201 39.03 22.2454 32.2776C23.0954 29.6382 25.9082 28.078 28.5198 27.7145C37.8286 26.7247 47.2162 26.7247 56.525 27.7145C59.1142 28.078 61.927 29.6605 62.777 32.2776C64.0949 39.0314 64.0873 45.977 62.7546 52.728Z"
                                                    fill="#996B4B"></path>
                                            </svg>

                                            <div class="d-flex flex-col boucher-text uppercase">
                                                <p>{{ truncateFileName(video.videos_caption) }}</p>
                                                <span>Youtube</span>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 align-items-center">

                                            <a :href="video.videos_link" target="_blank">
                                                <img src="/assets/view.svg" alt="" style="height: 30px">
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
        contentItems: Array
    },
    data() {
        return {
            socialLinks: {},
            videos: null
        }
    },
    components: {
        MainLayoutVue
    },
    computed: {
        boucherFilesLength() {
            return Object.keys(this.content.boucher_files).length;
        },
        facebookLastSegment() {
            return this.getLastSegment(this.socialLinks.facebook);
        },
        twitterLastSegment() {
            return this.getLastSegment(this.socialLinks.twitter);
        },
        linkedinLastSegment() {
            return this.getLastSegment(this.socialLinks.linkedin);
        },
        instagramLastSegment() {
            return this.getLastSegment(this.socialLinks.instagram);
        }
    },
    created() {
        this.parseSocialLinks();

        this.videos = JSON.parse(this.content.videos_link);

    },
    methods: {
        getLastSegment(url) {
            if (url) {
                const parts = url.split('/').filter(part => part); // Filter out empty strings
                return parts[parts.length - 1].replace(/[-_]/g, ' ').trim(); // Replace dashes and underscores with spaces, and trim any extra spaces
            }
            return '';
        },
        removeFileExtension(fileName) {
            if (fileName && typeof fileName === 'string') {
                return fileName.replace(/\.[^/.]+$/, "");
            }
        },

        truncateFileName(fileName) {
            if (fileName) {
                const maxLength = 35;
                if (fileName.length > maxLength) {
                    return fileName.substring(0, maxLength) + "...";
                }
            }
        },
        getFileType(fileName) {
            if (fileName && typeof fileName === 'string') {
                const extension = fileName.split('.').pop();
                return extension.toUpperCase() + " FILE";
            }
        },
        parseSocialLinks() {
            try {
                this.socialLinks = JSON.parse(this.content.social_links);
            } catch (error) {
                console.error('Error parsing social_links JSON:', error);
            }
        },
    }
}
</script>

<style scoped>
.about-section {
    padding: 50px 35px;
}
</style>
