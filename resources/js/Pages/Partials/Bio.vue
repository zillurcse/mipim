<template>
    <div class="bg-white overflow-hidden shadow-xl px-4 py-4 w-3/4   sm:rounded-lg">
        <div class="flex justify-between items-center ">
            <h1 class="text-xl text-gray-800  font-bold ">Add Bio</h1>
            <div class="w-10 h-10 flex items-center justify-center rounded-full  bg-brand text-white cursor-pointer "
                @click="showModal = 'bio'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

            </div>


            <div class="modal" v-if="showModal === 'bio'">
                <div class="modal-overlay" @click="closeModal"></div>
                <div class="modal-content">

                    <div class="mb-6">
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="title" id="title" v-model="bioTitle"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter Title" required />
                    </div>
                    <div class="mb-6">

                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            message</label>
                        <textarea id="message" rows="4" v-model="bioDesc"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."></textarea>

                    </div>

                    <div class="">
                        <button type="button" @click="uploadBioFiles"
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
export default {
    data() {
        return {

            bioItems: [],
            selectedTab: 'bio',
            showModal: '',

            isLoading: false,
            isOpenTool: null,


            bioTitle: '',
            bioDesc: '',


            tempAttachments: [],
            attachments: [],


        }
    },
    async mounted() {

        this.getBioData()

    },

    methods: {

        async getBioData() {
            await axios.get('/api/bio-container')
                .then(response => {
                    console.log();
                    if (response.status == 200) {
                        this.bioItems = response.data.data.items
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
        async uploadBioFiles() {
            try {
                // Create FormData and append all data
                this.isLoading = true;
                let formData = new FormData();
                formData.append('title', this.bioTitle);
                formData.append('description', this.bioDesc);

                // Make POST request to upload the file and data
                const response = await axios.post('/api/bio-container', formData);

                // Handle success
                console.log('Response:', response.data);
                this.getBioData(); // Update content data
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

<style></style>
