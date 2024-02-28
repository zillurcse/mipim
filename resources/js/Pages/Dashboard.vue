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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
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
                                                <!-- <vue-dropzone ref="myDropzone" :options="awss3" id="dropzone" :awss3="awss3"
                                                    v-on:vdropzone-s3-upload-error="s3UploadError"
                                                    v-on:vdropzone-s3-upload-success="s3UploadSuccess">
                                                </vue-dropzone> -->
                                                <!-- <vue-dropzone ref="myVueDropzone" :include-styling="false"
                                                    :useCustomSlot="true" id="dropzone"
                                                    @vdropzone-upload-progress="uploadProgress" :options="dropzoneOptions"
                                                    @vdropzone-file-added="fileAdded"
                                                    @vdropzone-sending-multiple="sendingFiles"
                                                    @vdropzone-success-multiple="success" />
                                                <input id="dropzone-file" type="file" class="hidden" /> -->
                                                <vue-dropzone ref="myVueDropzone" :include-styling="false"
                                                    :useCustomSlot="true" id="dropzone"
                                                    @vdropzone-upload-progress="uploadProgress" :options="dropzoneOptions"
                                                    @vdropzone-file-added="fileAdded"
                                                    @vdropzone-sending-multiple="sendingFiles"
                                                    @vdropzone-success-multiple="success">
                                                    <div class="dropzone-container">
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
                                                    </div>
                                                </vue-dropzone>
                                            </label>

                                        </div>
                                    </div>
                                    <attachment-list :tempAttachments="getTempAttachments" :attachments="getAttachments" />
                                    <!-- Submit button -->
                                    <div class="">
                                        <button type="button" @click="uploadFiles"
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

                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-700 text-white ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
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


    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import AttachmentList from './AttachmentList.vue'

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
            selectedTab: 'banner',
            showModal: '',
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
                url: `https://httpbin.org/post`,
                // File Size allowed in MB
                maxFilesize: 102400000,
                // Authentication Headers like Access_Token of your application
                headers: {
                    Authorization: `Access Token`
                },
                // The way you want to receive the files in the server
                paramName: function (n) {
                    return "file[]";
                },
                dictDefaultMessage: "Upload Files Here xD",
                includeStyling: false,
                previewsContainer: false,
                thumbnailWidth: 250,
                thumbnailHeight: 140,
                uploadMultiple: true,
                parallelUploads: 20
            }

        }
    },
    async mounted() {
        await axios.get('/api/banner')
            .then(response => {
                if(response.status == 200){
                    this.items = response.data.data.item

                    console.log()
                }

            })
            .catch(error => {
                if (error.response.status == 422) {
                    this.errors = error.response.data.errors;
                } else {
                    this.toastMessage('error',error, 'check', '', 'times')
                }
            })
            .finally(() => {

            })
    },

    methods: {
        uploadFiles() {
            // Access dropzone instance and perform upload
            this.$refs.myDropzone.processQueue();
        },
        s3UploadError(errorMessage) {

        },
        s3UploadSuccess(s3ObjectLocation) {
            console.log(s3ObjectLocation)
        },
        // openModal() {
        //     console.log('tt');
        //     this.showModal = true;
        // },
        closeModal() {
            this.showModal = false;
        },
        fileAdded(file) {
            console.log("File Dropped => ", file);
            // Construct your file object to render in the UI
            let attachment = {};
            attachment._id = file.upload.uuid;
            attachment.title = file.name;
            attachment.type = "file";
            attachment.extension = "." + file.type.split("/")[1];
            attachment.user = JSON.parse(localStorage.getItem("user"));
            attachment.content = "File Upload by Select or Drop";
            attachment.thumb = file.dataURL;
            attachment.thumb_list = file.dataURL;
            attachment.isLoading = true;
            attachment.progress = null;
            attachment.size = file.size;
            this.tempAttachments = [...this.tempAttachments, attachment];
        },
        // a middle layer function where you can change the XHR request properties
        sendingFiles(files, xhr, formData) {
            console.log(
                "if you want to change the upload time or add data to the formData you can do it here."
            );
            console.log("Files sending", files);
        },
        // function where we get the upload progress
        uploadProgress(file, progress, bytesSent) {
            console.log("File Upload Progress", progress);
            this.tempAttachments.map(attachment => {
                if (attachment.title === file.name) {
                    attachment.progress = `${Math.floor(progress)}`;
                }
            });
        },
        // called on successful upload of a file
        success(file, response) {
            console.log("File uploaded successfully");
            console.log("Response is ->", response);
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
