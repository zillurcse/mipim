<template>
    <div class="bg-white overflow-hidden shadow-xl px-4 py-4 w-3/4   sm:rounded-lg">
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


            <div class=" ">
                <div v-if="contentItems.length > 0" class="row">
                    <div class="col-md-6 mb-3" v-for="(item, index) in contentItems" :key="item.id">
                        <drop :tag="'span'" @dragover="over = true" @dragleave="over = false"
                            @drop="handleDrop(index, ...arguments)">

                            <drag class="cursor-pointer" :transfer-data="index" @dragstart="is_dragging = true"
                                @dragend="is_dragging = false">

                                <div class="p-4 border rounded-md bg-gray-100"
                                    :class="[is_dragging ? 'is_dragging' : '']">

                                    <figure class="rounded-md overflow-hidden h-60 relative">
                                        <div class='embed-responsive h-full' v-if="item.type === 'PDF'">
                                            <embed :src="item.file" type="application/pdf" width="100%" height="100%" />
                                        </div>
                                        <VueDocPreview :value="item.file" type="office"
                                            v-else-if="item.type === 'Documents (word, ppt, excel)'" />

                                        <v-lazy-image style="border-radius: 9px 9px 0px 0px" :src="item.file" v-else
                                            class="object-cover"
                                            src-placeholder="https://d30komtae77sjh.cloudfront.net/assets/svgs/loading-image.svg" />
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
                            </drag>
                        </drop>
                    </div>
                </div>
                <div v-else>
                    <div class="col-md-12">
                        <div class="flex flex-col justify-center gap-2 items-center py-4 text-gray-500  ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-14">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                            <h2 class="text-2xl text-gray-500 font-medium">No Data Found</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" v-if="showModal === 'pdf'">
                <div class="modal-overlay" @click="closeModal"></div>
                <div class="modal-content">
                    <div class="mb-6">
                        <label for="type"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                        <select id="type" v-model="type" @change="updateAcceptAttribute"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="Select Type">Select Type</option>
                            <option value="PDF">PDF</option>
                            <option value="Video (YouTube)">Video (YouTube)</option>
                            <option value="Documents (word, ppt, excel)">Documents (word, ppt, excel)
                            </option>
                            <option value="Social links">Social links</option>
                            <option value="URLs">URLs</option>
                            <option value="Images">Images</option>


                        </select>
                        <div class="mb-6 mt-6">
                            <label for="#" class="text-sm text-gray-600 block mb-1 font-semibold">Choose
                                Content</label>

                            <div class="flex items-center justify-center w-full">
                                <label for="file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <!-- <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span> or drag and
                                            drop
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG,
                                            JPG or
                                            GIF
                                            (MAX. 800x400px)</p> -->
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Allowed types:
                                            {{ acceptedTypes }}</p>
                                    </div>
                                    <input id="file" type="file" class="hidden" @change="handleContentFileChange" />
                                </label>
                            </div>


                        </div>


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
                            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" wodth="30" v-if="isLoading"
                                height="30" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                <path fill="#fff"
                                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate"
                                        dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import VLazyImage from "v-lazy-image";
import { Drag, Drop } from 'vue-drag-drop';

import VueDocPreview from 'vue-doc-preview'

export default {
    components: {
        VLazyImage,
        Drag, Drop,
        VueDocPreview
    },
    data() {
        return {
            is_dragging: false,

            over: false,
            drag: false,

            contentItems: [],
            selectedTab: 'bio',
            showModal: '',


            isLoading: false,
            isOpenTool: null,

            title: '', // Store the title input value
            link: '', // Store the link input value
            type: 'Select Type', // Store the type input value
            contentFile: null, // Store the selected file
            acceptedTypes: 'Any', // Default accepted types
            acceptedExtensions: '',
            bioTitle: '',
            bioDesc: '',

            tempAttachments: [],
            attachments: [],


        }
    },
    async mounted() {

        this.getContentData()

    },

    methods: {

        updateAcceptAttribute() {
            switch (this.type) {
                case 'PDF':
                    this.acceptedTypes = 'PDF';
                    this.acceptedExtensions = '.pdf';
                    break;
                case 'Documents (word, ppt, excel)':
                    this.acceptedTypes = 'Word, PowerPoint, Excel';
                    this.acceptedExtensions = '.doc,.docx,.ppt,.pptx,.xls,.xlsx';
                    break;
                case 'Images':
                    this.acceptedTypes = 'Image';
                    this.acceptedExtensions = '.jpg,.jpeg,.png,.gif';
                    break;
                default:
                    this.acceptedTypes = 'Any';
                    this.acceptedExtensions = '';
            }
            // Set the accept attribute based on the selected type
            document.getElementById('file').setAttribute('accept', this.acceptedExtensions);
        },
        handleDrop(to_index, from_index) {
            var temp = this.contentItems[to_index];

            this.contentItems[to_index] = this.contentItems[from_index];
            this.contentItems[from_index] = temp;
            this.over = false;

            axios.post('/api/content/update_order', { contents: this.contentItems })
                .then(res => {
                    // Vue.toasted.show('hola billo');
                    this.$toasted.success(res.data.message, {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration: 5000
                    });
                    this.getContentData()

                })
                .catch(err => {
                    this.$toasted.show(err.response.data.message, {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration: 5000
                    });


                })
                .finally(res => {
                    console.log(res);

                })
            console.log(to_index, from_index);
            //alert(`You dropped with data: ${JSON.stringify(data)}`);
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


        handleContentFileChange(event) {

            this.contentFile = event.target.files[0];
            console.log(this.contentFile);

        },

        async uploadContentFiles() {
            try {
                if (this.title === "" || this.link === '' || this.type === "" || this.contentFile === null) {
                    this.$toasted.show("please fill up all fields", {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration: 5000
                    });
                    return false
                }
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

                this.getContentData(); // Update content data
                this.showModal = false; // Close the modal after successful upload
                // Reset all data
                this.title = '';
                this.link = '';
                this.type = 'Select Type';
                this.contentFile = null;
                this.isLoading = false;
                this.$toasted.success(response.data.message, {
                    theme: "toasted-primary",
                    position: "top-center",
                    duration: 5000
                });

            } catch (error) {
                // Handle error
                this.isLoading = true;
                this.$toasted.show(error.response.data.message, {
                    theme: "toasted-primary",
                    position: "top-center",
                    duration: 5000
                });
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
}
</script>

<style>
.is_dragging {
    overflow: hidden;
    border: 1px dotted #9A5626 !important;
}
</style>
