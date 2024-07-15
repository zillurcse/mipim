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
                    <div v-if="categoryItems.length > 0" class="row">
                        <div class="col-md-4 mb-3" v-for="categorie in categoryItems" :key="categorie.id">

                            <div class="px-3 py-3 shadow-sm border rounded-lg relative h-full flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="#9A5626" class="w-5 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                                <h2 class="text-base text-gray-800 font-medium ">{{ categorie.name }}</h2>
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
    name: "Category",
    components: {
        MainLayoutVue
    },
    data() {
        return {
            categoryItems: [],
        }
    },
    async mounted() {
        await this.getCategoryData();

    },

    methods: {
        async getCategoryData() {
            await axios.get('/api/web/category')
                .then(response => {

                    if (response.status === 200) {
                        this.categoryItems = response.data.data.items

                    }

                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        // this.toastMessage('error', error, 'check', '', 'times')
                        console.log(error);
                    }
                })
                .finally(() => {

                })
        },
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
</style>
