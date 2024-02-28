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
                                        PDF
                                    </a>
                                </li>

                            </ul>

                        </div>


                    </div>
                    <div class="bg-white overflow-hidden shadow-xl px-4 py-4 w-3/4   sm:rounded-lg"
                         v-if="selectedTab === 'banner'">
                        <div class="flex justify-between items-center">
                            <h1 class="text-xl text-gray-800  font-bold ">Add Banner</h1>
                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-700 text-white "
                                 @click="showModal = 'banner'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                            </div>
                        </div>
                        <div class="my-4">


                            <div class="row ">
                                <div class="col-md-6">
                                    <figure class="rounded-md overflow-hidden">
                                        <img src="/assets/img/e753507e60b3096fb02daf618c212858.png" alt="">
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
                                            <label for="dropzone-file"
                                                   class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                <!-- File upload field -->
<!--                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">-->
<!--                                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"-->
<!--                                                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg"-->
<!--                                                         fill="none"-->
<!--                                                         viewBox="0 0 20 16">-->
<!--                                                        <path stroke="currentColor" stroke-linecap="round"-->
<!--                                                              stroke-linejoin="round" stroke-width="2"-->
<!--                                                              d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>-->
<!--                                                    </svg>-->
<!--                                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span-->
<!--                                                        class="font-semibold">Click to-->
<!--                                                            upload</span> or drag and drop</p>-->
<!--                                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or-->
<!--                                                        GIF-->
<!--                                                        (MAX. 800x400px)</p>-->
<!--                                                </div>-->
                                                <vue-dropzone
                                                    :awss3="awss3"
                                                    v-on:vdropzone-s3-upload-error="s3UploadError"
                                                    v-on:vdropzone-s3-upload-success="s3UploadSuccess"
                                                >
                                                </vue-dropzone>

                                                <input id="dropzone-file" type="file" class="hidden"/>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Submit button -->
                                    <div class="">
                                        <button type="button"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-xl px-4 py-4 w-3/4   sm:rounded-lg"
                         v-else-if="selectedTab === 'pdf'">
                        <div class="flex justify-between items-center" @click="showModal = 'pdf'">
                            <h1 class="text-xl text-gray-800  font-bold ">Add PDF</h1>

                            <div
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-700 text-white ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>

                            </div>
                        </div>

                        <div class="my-4">


                            <div class="row ">
                                <div class="col-md-6">
                                    <figure class="rounded-md overflow-hidden">
                                        <img src="/assets/img/e753507e60b3096fb02daf618c212858.png"
                                             alt="">
                                    </figure>
                                </div>
                            </div>
                            <div class="modal" v-if="showModal === 'pdf'">
                                <div class="modal-overlay" @click="closeModal"></div>
                                <div class="modal-content">
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
                                               placeholder="Enter Title" required/>
                                    </div>
                                    <div class="mb-6">
                                        <label for="Link"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link</label>
                                        <input type="Link" id="Link"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               placeholder="Enter link" required/>
                                    </div>
                                    <div class="mb-6">
<!--                                        <label for="#" class="text-sm text-gray-600 block mb-1 font-semibold">Choose-->
<!--                                            PDF:</label>-->
<!--                                        <div class="flex items-center justify-center w-full">-->
<!--                                            <label for="dropzone-file"-->
<!--                                                   class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">-->
<!--                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">-->
<!--                                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"-->
<!--                                                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg"-->
<!--                                                         fill="none"-->
<!--                                                         viewBox="0 0 20 16">-->
<!--                                                        <path stroke="currentColor" stroke-linecap="round"-->
<!--                                                              stroke-linejoin="round" stroke-width="2"-->
<!--                                                              d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>-->
<!--                                                    </svg>-->
<!--                                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span-->
<!--                                                        class="font-semibold">Click to upload</span> or drag and drop-->
<!--                                                    </p>-->
<!--                                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or-->
<!--                                                        GIF-->
<!--                                                        (MAX.-->
<!--                                                        800x400px)</p>-->
<!--                                                </div>-->
<!--                                                <input type="file" class="hidden" id="pdf" name="pdf" accept=".pdf"-->
<!--                                                       required/>-->
<!--                                            </label>-->
                                        </div>

                                    </div>
                                    <div class="">
                                        <button type="button"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Submit
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
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    components: {
        AppLayout,
        Welcome,
        vueDropzone: vue2Dropzone
    },
    data() {
        return {
            selectedTab: 'banner',
            showModal: '',
            awss3: {
                signingURL: 'http://aws-direct-s3.dev/',
                headers: {},
                params : {},
                sendFileToServer : true,
                withCredentials: false
            },

        }
    },

    methods: {
        s3UploadError(errorMessage){

        },
        s3UploadSuccess(s3ObjectLocation){
            console.log(s3ObjectLocation)
        },
            // openModal() {
        //     console.log('tt');
        //     this.showModal = true;
        // },
        closeModal() {
            this.showModal = false;
        }
    }
}
</script>
<style scoped>
.active {
    background: #1d4ed8 !important;
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
