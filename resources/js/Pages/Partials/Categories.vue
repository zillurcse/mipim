<template>
    <div class="bg-white overflow-hidden shadow-xl px-4 py-4 w-3/4   sm:rounded-lg">
        <div class="flex justify-between items-center ">
            <h1 class="text-xl text-gray-800  font-bold ">Categories</h1>
            <div class="w-10 h-10 flex items-center justify-center rounded-full  bg-brand text-white cursor-pointer "
                @click="showModal = 'categories'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

            </div>


        </div>
        <div class="my-4">

            <div class=" ">
                <div v-if="categoriesData.length > 0" class="row">
                    <div class="col-md-6 mb-3" v-for="(category, index) in categoriesData " :key="category.id">
                        <drop :tag="'span'" @dragover="over = true" @dragleave="over = false"
                            @drop="handleDrop(index, ...arguments)">

                            <drag class="cursor-pointer h-full" :transfer-data="index" @dragstart="is_dragging = true"
                                @dragend="is_dragging = false">
                                <div class="p-3 border rounded-lg relative h-full">
                                    <p class="text-gray-800 mb-2" style="font-size: 15px;">

                                        {{
                    category.name.length > 110 ? category.name.substring(0, 110) + "..." :
                        category.name
                }}
                                    </p>
                                    <div class="absolute top-2 right-2 text-gray-400 cursor-pointer"
                                        @click="clickTool(category.id, index)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>
                                        <div class="w-52  z-10  absolute  right-0 rounded-md bg-white  text-gray-700 shadow-sm"
                                            v-if="isOpenTool === category.id">
                                            <button class="cursor-pointer hover:text-red-700 p-2 border-b w-full"
                                                @click="openCategories(category)">
                                                Update categories
                                            </button>
                                            <button class="cursor-pointer hover:text-red-700 p-2 w-full"
                                                @click="deleteCategoryItem(category.id, index)">
                                                Delete categories
                                            </button>
                                        </div>
                                    </div>

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


            <div class="modal" v-if="showModal === 'categories'">
                <div class="modal-overlay" @click="closeModal"></div>
                <div class="modal-content">

                    <div class="mb-6">
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="title" id="title" v-model="categories"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter Title" required />
                    </div>

                    <div class="">
                        <button type="button" @click="uploadCategories" v-if="!isUpdate"
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
                        <button type="button" @click="updateCategories()" v-if="isUpdate"
                            class="text-white flex items-center justify-center gap-4  bg-brand hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 h-12  text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Update
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
import { Drag, Drop } from 'vue-drag-drop';

export default {
    components: {
        Drag, Drop,
    },
    props: {
        categoriesData: Array
    },
    data() {
        return {
            categories: '',
            category_index: '',
            updatedId: '',
            selectedTab: 'categories',
            showModal: '',

            isLoading: false,
            isOpenTool: null,
            isUpdate: false,
            is_dragging: false,
            over: false,
            drag: false,


            tempAttachments: [],
            attachments: [],


        }
    },
    mounted() {
        // await this.getCategoriesData()
    },

    methods: {
        handleFileChange(event) {
            this.bannerImage = event.target.files[0];
        },
        handleContentFileChange(event) {
            this.contentFile = event.target.files[0];
        },
        async uploadCategories() {
            try {
                if (this.categories === "") {
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
                formData.append('name', this.categories);

                // Make POST request to upload the file and data
                const response = await axios.post('/api/categories', formData);

                // Handle success
                if (response.status === 200) {
                    this.categoriesData.push(response.data.data)

                    this.showModal = false;
                    this.categories = '';
                    this.isLoading = false;
                }

            } catch (error) {
                // Handle error
                this.isLoading = true;

                console.error('Error:', error);
            }
        },

        openCategories(item) {
            this.updatedId = item.id
            this.showModal = 'categories';
            this.isUpdate = true
            this.categories = item.name;

        },


        deleteCategoryItem(id, index) {
            // Send a DELETE request to the backend with the item's ID
            axios
                .delete(`/api/categories/${id}`)
                .then((response) => {
                    this.$delete(this.categoriesData, index);
                    this.$toasted.show(response.data.message, {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration: 5000
                    });
                })
                .catch((error) => {
                    console.error("Error deleting resource:", error);
                    // Handle error if needed
                });
        },

        async updateCategories() {
            try {
                this.isLoading = true;

                const formData = new FormData();
                formData.append('name', this.categories);


                const response = await axios.post(`/api/categories/${this.updatedId}`, formData);

                // Handle success
                if (response.status === 200) {
                    this.$set(this.categoriesData, this.category_index, response.data.data);
                    this.showModal = false;
                    // Reset all data
                    this.categories = '';

                    this.isLoading = false;
                    this.isUpdate = false;
                }

            } catch (error) {
                // Handle error
                console.error("Error:", error);
                this.isLoading = false;
                // Add specific error handling as needed
            }
        },
        handleDrop(to_index, from_index) {
            var temp = this.categoriesData[to_index];

            this.categoriesData[to_index] = this.categoriesData[from_index];
            this.categoriesData[from_index] = temp;
            this.over = false;

            axios.post('/api/categories/update/order', { categories: this.categoriesData })
                .then(res => {
                    console.log(res);
                    this.$toasted.success(res.data.message, {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration: 5000
                    });
                    this.getCategoriesData()

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

        },

        clickTool(id, index) {
            if (this.isOpenTool === id) {
                this.isOpenTool = -1
                this.category_index = index
            } else {
                this.isOpenTool = id;
                this.category_index = null
            }
        },

        closeModal() {
            this.showModal = false
        }

    },
}
</script>

<style></style>
