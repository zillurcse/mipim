<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                MIPIM - Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex gap-4 ">
                    <div class="w-1/4 p-3 bg-gray-200 rounded-lg">


                        <div class="md:flex w-full">
                            <ul
                                class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 w-full md:me-4 mb-4 md:mb-0">

                                <li>
                                    <a href="#"
                                        class="inline-flex items-center px-4 py-3 text-base no-underline text-gray-500 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white"
                                        @click="selectedTab = 'banner'" :class="{ 'active': selectedTab === 'banner' }">
                                        Banner
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="inline-flex items-center px-4 py-3 text-base no-underline text-gray-500 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white"
                                        @click="selectedTab = 'pdf'" :class="{ 'active': selectedTab === 'pdf' }">
                                        Content
                                    </a>
                                </li>

                            </ul>

                        </div>


                    </div>
                    <div class="bg-white overflow-hidden shadow-xl px-4 py-4 w-3/4   sm:rounded-lg"
                        v-if="selectedTab === 'banner'">
                        <div class="flex justify-between items-center">
                            <h1 class="text-xl text-gray-800  font-bold ">Add Banner</h1>
                            <div class="w-10 h-10 flex items-center justify-center  rounded-full bg-brand text-white cursor-pointer "
                                @click="showModal = 'banner'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </div>
                        <div class="my-4">


                            <div class="row ">
                                <div class="col-md-6 mb-3" v-for="item in items" :key="item.id">
                                    <figure class="rounded-md overflow-hidden h-60 relative">
                                        <img :src="item.banner_image" alt="" class="object-cover">
                                        <div class="absolute top-2 right-2 text-gray-400 cursor-pointer"
                                            @click="clickTool(item.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>
                                            <div class="w-40 p-3 absolute  right-0 rounded-md bg-white text-gray-700 "
                                                v-if="isOpenTool === item.id">
                                                <button class="cursor-pointer hover:text-red-700"
                                                    @click="deleteBannerItem(item.id)">
                                                    Delete Banner
                                                </button>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                            <div class="modal" v-if="showModal === 'banner'">
                                <div class="modal-overlay" @click="closeModal"></div>
                                <div class="modal-content">
                                    <div class="mb-6">
                                        <label for="#" class="text-sm text-gray-600 block mb-1 font-semibold">Choose
                                            Banner</label>

                                        <div class="flex items-center justify-center w-full">
                                            <label for="file"
                                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 20 16">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                    </svg>
                                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                            class="font-semibold">Click to upload</span> or drag and drop
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                                                        (MAX. 800x400px)</p>
                                                </div>
                                                <input id="file" type="file" class="hidden" @change="handleFileChange" />
                                            </label>
                                        </div>


                                    </div>
                                    <!-- <attachment-list :tempAttachments="getTempAttachments" :attachments="getAttachments" />
                                    Submit button -->
                                    <div class="">
                                        <button type="button" @click="uploadFiles"
                                            class="text-white  flex items-center justify-center h-12 gap-4  bg-brand hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5  text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Submit


                                            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" wodth="30"
                                                v-if="isLoading" height="30" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0"
                                                xml:space="preserve">
                                                <path fill="#fff"
                                                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                                    <animateTransform attributeName="transform" attributeType="XML"
                                                        type="rotate" dur="1s" from="0 50 50" to="360 50 50"
                                                        repeatCount="indefinite" />
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-xl px-4 py-4 w-3/4   sm:rounded-lg"
                        v-else-if="selectedTab === 'pdf'">
                        <div class="flex justify-between items-center ">
                            <h1 class="text-xl text-gray-800  font-bold ">Add Content</h1>

                            <div class="w-10 h-10 flex items-center justify-center rounded-full  bg-brand text-white cursor-pointer "
                                @click="showModal = 'pdf'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>

                            </div>
                        </div>

                        <div class="my-4">


                            <div class="row ">
                                <div class="col-md-6 mb-3" v-for="item in contentItems" :key="item.id">
                                    <div class="p-4 border rounded-md bg-gray-100">

                                        <figure class="rounded-md overflow-hidden h-60 relative">
                                            <div class='embed-responsive h-full' v-if="item.type === 'PDF'">
                                                <embed :src="item.file" type="application/pdf" width="100%" height="100%" />
                                            </div>
                                            <img :src="item.file" alt="" class="object-cover" v-else>

                                            <div class="absolute top-2 right-2 text-gray-400 cursor-pointer"
                                                @click="clickTool(item.id)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                                </svg>
                                                <div class="w-40 p-3 absolute  right-0 rounded-md bg-white text-gray-700 "
                                                    v-if="isOpenTool === item.id">
                                                    <button class="cursor-pointer hover:text-red-700"
                                                        @click="deleteContentItem(item.id)">
                                                        Delete Content
                                                    </button>
                                                </div>
                                            </div>
                                        </figure>
                                        <h2 class="text-xl text-gray-800 font-semibold">{{ item.title }}</h2>
                                        <h3 class="text-lg text-gray-700 font-medium">{{ item.type }}</h3>
                                        <h4 class="text-base text-gray-700 font-medium">{{ item.link }}</h4>
                                    </div>

                                </div>
                            </div>
                            <div class="modal" v-if="showModal === 'pdf'">
                                <div class="modal-overlay" @click="closeModal"></div>
                                <div class="modal-content">
                                    <div class="mb-6">
                                        <div class="mb-6">
                                            <label for="#" class="text-sm text-gray-600 block mb-1 font-semibold">Choose
                                                Banner</label>

                                            <div class="flex items-center justify-center w-full">
                                                <label for="file"
                                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                        </svg>
                                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                                class="font-semibold">Click to upload</span> or drag and
                                                            drop
                                                        </p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or
                                                            GIF
                                                            (MAX. 800x400px)</p>
                                                    </div>
                                                    <input id="file" type="file" class="hidden"
                                                        @change="handleContentFileChange" />
                                                </label>
                                            </div>


                                        </div>
                                        <label for="type"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                        <select id="type" v-model="type"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected>Select Type</option>
                                            <option value="PDF">PDF</option>
                                            <option value="Video (YouTube)">Video (YouTube)</option>
                                            <option value="Documents (word, ppt, excel)">Documents (word, ppt, excel)
                                            </option>
                                            <option value="Social links">Social links</option>
                                            <option value="URLs">URLs</option>
                                            <option value="Images">Images</option>


                                        </select>

                                    </div>
                                    <div class="mb-6">
                                        <label for="title"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                        <input type="title" id="title" v-model="title"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Enter Title" required />
                                    </div>
                                    <div class="mb-6">
                                        <label for="Link"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link</label>
                                        <input type="Link" id="Link" v-model="link"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Enter link" required />
                                    </div>

                                    <div class="">
                                        <button type="button" @click="uploadContentFiles"
                                            class="text-white flex items-center justify-center gap-4  bg-brand hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 h-12  text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Submit
                                            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" wodth="30"
                                                v-if="isLoading" height="30" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0"
                                                xml:space="preserve">
                                                <path fill="#fff"
                                                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                                    <animateTransform attributeName="transform" attributeType="XML"
                                                        type="rotate" dur="1s" from="0 50 50" to="360 50 50"
                                                        repeatCount="indefinite" />
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import AttachmentList from './AttachmentList.vue'
import axios from 'axios';
export default {
    components: {
        AppLayout,
        Welcome,
        vueDropzone: vue2Dropzone,
        AttachmentList
    },

    data() {
        return {
            items: [],
            contentItems: [],
            selectedTab: 'banner',
            showModal: '',
            bannerImage: null,

            isLoading: false,
            isOpenTool: null,

            title: '', // Store the title input value
            link: '', // Store the link input value
            type: '', // Store the type input value
            contentFile: null, // Store the selected file


            awss3: {
                signingURL: 'http://aws-direct-s3.dev/',
                headers: {},
                params: {},
                sendFileToServer: true,
                withCredentials: false
            },
            tempAttachments: [],
            attachments: [],
            dropzoneOptions: {
                // The Url Where Dropped or Selected files will be sent
                url: `/api/banner`,
                maxFilesize: 10,
                uploadMultiple: false,
                parallelUploads: 20,
                headers: {
                    "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                }
            },
            dataURL: null

        }
    },
    async mounted() {
        this.getBannerData()
        this.getContentData()

    },

    methods: {
        async getBannerData() {
            await axios.get('/api/banner')
                .then(response => {
                    console.log();
                    if (response.status == 200) {
                        this.items = response.data.data.items
                        console.log(this.items);
                        console.log()
                    }

                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        // this.toastMessage('error', error, 'check', '', 'times')
                        console.log(error);
                    }
                })
                .finally(() => {

                })
        },
        async getContentData() {
            await axios.get('/api/content')
                .then(response => {
                    console.log();
                    if (response.status == 200) {
                        this.contentItems = response.data.data.items
                        console.log(this.contentItems);
                        console.log()
                    }

                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        // this.toastMessage('error', error, 'check', '', 'times')
                        console.log(error);
                    }
                })
                .finally(() => {

                })
        },

        handleFileChange(event) {

            this.bannerImage = event.target.files[0];
            console.log(this.bannerImage);

        },
        handleContentFileChange(event) {

            this.contentFile = event.target.files[0];
            console.log(this.contentFile);

        },
        // async uploadContentFiles() {
        //     let formdata = new FormData();
        //     formdata.append('file', this.contentFile)
        //     await axios.post('/api/content', formdata)
        //         .then(response => {
        //             // Handle success
        //             console.log('Response:', response.data);
        //             this.getContentData()
        //             this.showModal = false;

        //         })
        //         .catch(error => {
        //             // Handle error
        //             console.error('Error:', error);
        //         });
        // },
        async uploadContentFiles() {
            try {
                // Create FormData and append all data
                this.isLoading = true;
                let formData = new FormData();
                formData.append('title', this.title);
                formData.append('link', this.link);
                formData.append('type', this.type);
                formData.append('file', this.contentFile);

                // Make POST request to upload the file and data
                const response = await axios.post('/api/content', formData);

                // Handle success
                console.log('Response:', response.data);
                this.getContentData(); // Update content data
                this.showModal = false; // Close the modal after successful upload
                // Reset all data
                this.title = '';
                this.link = '';
                this.type = '';
                this.contentFile = null;
                this.isLoading = false;

            } catch (error) {
                // Handle error
                this.isLoading = true;

                console.error('Error:', error);
            }
        },
        async uploadFiles() {

            try {
                // Create FormData and append all data
                this.isLoading = true;
                let formdata = new FormData();
                formdata.append('file', this.bannerImage)

                // Make POST request to upload the file and data
                const response = await axios.post('/api/banner', formdata)

                // Handle success
                console.log('Response:', response.data);
                this.getBannerData()
                this.showModal = false;
                this.isLoading = false;
                this.bannerImage = null
            } catch (error) {
                // Handle error
                this.isLoading = true;

                console.error('Error:', error);
            }




        },
        deleteContentItem(id) {
            console.log(id);
            // Send a DELETE request to the backend with the item's ID
            axios.delete(`/api/content/${id}`)
                .then(response => {
                    console.log(response.data.message);
                    this.getContentData()
                    // Assuming you want to remove the item from the frontend after successful deletion
                    // You can trigger a method to refresh the list of items or remove the deleted item from the UI
                })
                .catch(error => {
                    console.error('Error deleting resource:', error);
                    // Handle error if needed
                });
        },
        deleteBannerItem(id) {
            // Send a DELETE request to the backend with the item's ID
            axios.delete(`/api/banner/${id}`)
                .then(response => {
                    console.log(response.data.message);
                    this.getBannerData()

                    // Assuming you want to remove the item from the frontend after successful deletion
                    // You can trigger a method to refresh the list of items or remove the deleted item from the UI
                })
                .catch(error => {
                    console.error('Error deleting resource:', error);
                    // Handle error if needed
                });
        },

        clickTool(id) {
            if (this.isOpenTool == id) {
                this.isOpenTool = -1
            } else {
                this.isOpenTool = id;
            }
        },

        closeModal() {
            this.showModal = false
        }

    },
    computed: {
        getTempAttachments() {
            return this.tempAttachments;
        },
        getAttachments() {
            return this.attachments;
        }
    }
}

</script>
<style scoped>
.bg-brand {
    background-color: #9A5626;
}

.active {
    background: #9A5626 !important;
    color: #fff !important;
}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    position: relative;
    background-color: #fff;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width: 50%;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.modal-title {
    font-size: 20px;
    font-weight: bold;
}

.close-btn {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #999;
}

.modal-body {
    margin-bottom: 20px;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
}

.btn-submit,
.btn-cancel {
    padding: 8px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-submit {
    background-color: #007bff;
    color: #fff;
}

.btn-cancel {
    background-color: #ccc;
    margin-left: 10px;
}
</style>


<!-- <div class="mb-6">
    <label for="#" class="text-sm text-gray-600 block mb-1 font-semibold">Choose Banner</label>
    <div class="flex items-center justify-center w-full">
        <label for="dropzone-file"
            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                        class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                    800x400px)</p>
            </div>
            <input id="dropzone-file" type="file" class="hidden" />
        </label>
    </div>

</div>

<div class="">
    <button type="button"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</div> -->


<!--

    <div class="mb-6">

                            <label for="type"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                            <select id="type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Select Type</option>
                                <option value="Type1">Type 1</option>
                                <option value="Type2">Type 2</option>
                                <option value="Type3">Type 3</option>
                            </select>

                        </div>
                        <div class="mb-6">
                            <label for="title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="title" id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter Title" required />
                        </div>
                        <div class="mb-6">
                            <label for="Link"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link</label>
                            <input type="Link" id="Link"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter link" required />
                        </div>
                        <div class="mb-6">
                            <label for="#" class="text-sm text-gray-600 block mb-1 font-semibold">Choose PDF:</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                            800x400px)</p>
                                    </div>
                                    <input type="file" class="hidden" id="pdf" name="pdf" accept=".pdf" required />
                                </label>
                            </div>

                        </div>
                        <div class="">
                            <button type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </div>
 -->
 <!-- <div class="flex items-center justify-center w-full">
    <label for="dropzone-file"
        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
        File upload field
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2"
                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />

            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                    class="font-semibold">Click to
                    upload</span> or drag and drop</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or
                GIF
                (MAX. 800x400px)</p>
        </div>
        <!-- <vue-dropzone ref="myDropzone" :options="awss3" id="dropzone" :awss3="awss3"
            v-on:vdropzone-s3-upload-error="s3UploadError"
            v-on:vdropzone-s3-upload-success="s3UploadSuccess">
        </vue-dropzone>
        <vue-dropzone ref="myVueDropzone" :include-styling="false"
            :useCustomSlot="true" id="dropzone"
            @vdropzone-upload-progress="uploadProgress" :options="dropzoneOptions"
            @vdropzone-file-added="fileAdded"
            @vdropzone-sending-multiple="sendingFiles"
            @vdropzone-success-multiple="success" />
        <input id="dropzone-file" type="file" class="hidden" /> -->

        <!--                                                   <vue-dropzone ref="myVueDropzone" :include-styling="false"-->
        <!--                                                    :useCustomSlot="true" id="dropzone"-->
        <!--                                                    @vdropzone-upload-progress="uploadProgress" :options="dropzoneOptions"-->
        <!--                                                    @vdropzone-file-added="fileAdded" @vdropzone-success-multiple="success"-->
        <!--                                                    @vdropzone-sending-multiple="sendingFiles">-->
        <!-- <div class="dropzone-container">
                <div class="file-selector text-center">
                    <figure class="flex justify-center items-center">
                        <svg width="104px" height="104px" viewBox="0 0 104 104"
                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs>
                                <circle id="path-1" cx="36" cy="36" r="36"></circle>
                                <filter x="-37.5%" y="-29.2%" width="175.0%"
                                    height="175.0%" filterUnits="objectBoundingBox"
                                    id="filter-2">
                                    <feOffset dx="0" dy="6" in="SourceAlpha"
                                        result="shadowOffsetOuter1"></feOffset>
                                    <feGaussianBlur stdDeviation="8"
                                        in="shadowOffsetOuter1"
                                        result="shadowBlurOuter1"></feGaussianBlur>
                                    <feColorMatrix
                                        values="0 0 0 0 0.0117647059   0 0 0 0 0.0862745098   0 0 0 0 0.160784314  0 0 0 0.08 0"
                                        type="matrix" in="shadowBlurOuter1"
                                        result="shadowMatrixOuter1"></feColorMatrix>
                                    <feOffset dx="0" dy="1" in="SourceAlpha"
                                        result="shadowOffsetOuter2"></feOffset>
                                    <feGaussianBlur stdDeviation="1"
                                        in="shadowOffsetOuter2"
                                        result="shadowBlurOuter2"></feGaussianBlur>
                                    <feColorMatrix
                                        values="0 0 0 0 0.0117647059   0 0 0 0 0.0862745098   0 0 0 0 0.160784314  0 0 0 0.11 0"
                                        type="matrix" in="shadowBlurOuter2"
                                        result="shadowMatrixOuter2"></feColorMatrix>
                                    <feMerge>
                                        <feMergeNode in="shadowMatrixOuter1">
                                        </feMergeNode>
                                        <feMergeNode in="shadowMatrixOuter2">
                                        </feMergeNode>
                                    </feMerge>
                                </filter>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1"
                                fill="none" fill-rule="evenodd">
                                <g id="Artboard"
                                    transform="translate(-460.000000, -125.000000)">
                                    <g id="Group-4"
                                        transform="translate(412.000000, 129.000000)">
                                        <g id="Group-2"
                                            transform="translate(58.000000, 0.000000)">
                                            <circle id="Oval" fill="#3560FF"
                                                opacity="0.100000001" cx="42"
                                                cy="42" r="42"></circle>
                                            <g id="Group"
                                                transform="translate(6.000000, 6.000000)">
                                                <g id="Oval">
                                                    <use fill="black"
                                                        fill-opacity="1"
                                                        filter="url(#filter-2)"
                                                        xlink:href="#path-1"></use>
                                                    <use fill="#FFFFFF"
                                                        fill-rule="evenodd"
                                                        xlink:href="#path-1"></use>
                                                </g>
                                                <g id="upload-cloud"
                                                    transform="translate(21.818182, 24.000000)"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2">
                                                    <polyline id="Path"
                                                        stroke="#000000"
                                                        points="19.6458087 17.3789847 14.3565525 12.0897285 9.06729634 17.3789847">
                                                    </polyline>
                                                    <path
                                                        d="M14.3565525,12.0897285 L14.3565525,24.1794569"
                                                        id="Path" stroke="#3560FF">
                                                    </path>
                                                    <path
                                                        d="M25.6438239,20.7792208 C28.2965835,19.3021499 29.6312816,16.1761528 28.8860265,13.1856562 C28.1407715,10.1951596 25.5052337,8.10125672 22.4838689,8.09921935 L20.8179512,8.09921935 C19.7219904,3.76967373 16.1275086,0.577339516 11.7773112,0.0700384831 C7.42711383,-0.43726255 3.22057026,1.84535014 1.19724759,5.81113853 C-0.826075091,9.77692693 -0.247870665,14.6059952 2.6515151,17.9569414"
                                                        id="Path" stroke="#3560FF">
                                                    </path>
                                                    <polyline id="Path"
                                                        stroke="#3560FF"
                                                        points="19.6458087 17.3789847 14.3565525 12.0897285 9.06729634 17.3789847">
                                                    </polyline>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </figure>
                    Drop Or Add Files Here
                    <p class="separator"><span> or </span></p>
                    <button type="button">Browse</button>
                </div>
            </div> -->
        <!--                                                </vue-dropzone>-->

    <!-- </label> -->

<!-- </div> -->
