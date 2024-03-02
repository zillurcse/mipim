<template>
    <div class="bg-white overflow-hidden shadow-xl px-4 py-4 w-3/4 sm:rounded-lg">
        <div class="flex justify-between items-center">
            <h1 class="text-xl text-gray-800 font-bold">Add Banner</h1>
            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-brand text-white cursor-pointer"
                @click="showModal = 'banner'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div>
        </div>
        <div class="my-4">
            <div class="row">
                <div class="col-md-6 mb-3" v-for="item in items" :key="item.id">
                    <figure class="rounded-md overflow-hidden h-60 relative">
                        <img :src="item.banner_image" alt="" class="object-cover" />
                        <div class="absolute top-2 right-2 text-gray-400 cursor-pointer" @click="clickTool(item.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                            <div class="w-40 p-3 absolute right-0 rounded-md bg-white text-gray-700"
                                v-if="isOpenTool === item.id">
                                <button class="cursor-pointer hover:text-red-700" @click="deleteBannerItem(item.id)">
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
                        <label for="#" class="text-sm text-gray-600 block mb-1 font-semibold">Choose Banner</label>

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
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">Click to upload</span>
                                        or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        SVG, PNG, JPG or GIF (MAX. 800x400px)
                                    </p>
                                </div>
                                <input id="file" type="file" class="hidden" @change="handleFileChange" />
                            </label>
                        </div>
                    </div>
                    <!-- <attachment-list :tempAttachments="getTempAttachments" :attachments="getAttachments" />
                                    Submit button -->
                    <div class="">
                        <button type="button" @click="uploadFiles"
                            class="text-white flex items-center justify-center h-12 gap-4 bg-brand hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
export default {
    data() {
        return {
            items: [],
            selectedTab: "bio",
            showModal: "",
            bannerImage: null,
            isLoading: false,
            isOpenTool: null,
            tempAttachments: [],
            attachments: [],
        };
    },
    async mounted() {
        this.getBannerData();
    },

    methods: {
        async getBannerData() {
            await axios
                .get("/api/banner")
                .then((response) => {
                    console.log();
                    if (response.status == 200) {
                        this.items = response.data.data.items;
                        console.log(this.items);
                        console.log();
                    }
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        // this.toastMessage('error', error, 'check', '', 'times')
                        console.log(error);
                    }
                })
                .finally(() => { });
        },

        handleFileChange(event) {
            this.bannerImage = event.target.files[0];
            console.log(this.bannerImage);
        },

        async uploadFiles() {
            try {
                // Create FormData and append all data
                this.isLoading = true;
                let formdata = new FormData();
                formdata.append("file", this.bannerImage);

                // Make POST request to upload the file and data
                const response = await axios.post("/api/banner", formdata);

                // Handle success
                console.log("Response:", response.data);
                this.getBannerData();
                this.showModal = false;
                this.isLoading = false;
                this.bannerImage = null;
            } catch (error) {
                // Handle error
                this.isLoading = true;

                console.error("Error:", error);
            }
        },

        deleteBannerItem(id) {
            // Send a DELETE request to the backend with the item's ID
            axios
                .delete(`/api/banner/${id}`)
                .then((response) => {
                    console.log(response.data.message);
                    this.getBannerData();

                    // Assuming you want to remove the item from the frontend after successful deletion
                    // You can trigger a method to refresh the list of items or remove the deleted item from the UI
                })
                .catch((error) => {
                    console.error("Error deleting resource:", error);
                    // Handle error if needed
                });
        },

        clickTool(id) {
            if (this.isOpenTool == id) {
                this.isOpenTool = -1;
            } else {
                this.isOpenTool = id;
            }
        },

        closeModal() {
            this.showModal = false;
        },
    },
};
</script>

<style></style>
