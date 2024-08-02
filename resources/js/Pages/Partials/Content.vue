<template>
    <div class="bg-white overflow-hidden shadow-xl px-4 py-4 w-3/4   sm:rounded-lg">
        <div class="flex justify-between items-center ">
            <h1 class="text-xl text-gray-800  font-bold ">All Content</h1>

            <div class="w-10 h-10 flex items-center justify-center rounded-full  bg-brand text-white cursor-pointer "
                @click="showModal = 'pdf'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div>
        </div>
        <div class="my-4">
            <div class="">
                <div v-if="contentItems.length > 0" class="row">
                    <div class="col-md-4 mb-3" v-for="(item, index) in contentItems" :key="item.id">
                        <drop :tag="'span'" @dragover="over = false" @dragleave="over = false"
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
                                                    @click="UpdateContent(item, index)">
                                                    Update Content
                                                </button>
                                                <button class="cursor-pointer hover:text-red-700"
                                                    @click="deleteContentItem(item.id, index)">
                                                    Delete Content
                                                </button>
                                            </div>

                                        </div>
                                    </figure>

                                    <h2 v-if="item.title" class=" text-gray-800 font-semibold" style="font-size: 15px;">
                                        {{ item.title.substring(0, 50) }}
                                    </h2>
                                    <!-- <h3 v-if="item.type" class="text-lg text-gray-700 font-medium">
                                        {{ item.type.substring(0, 20) }}
                                    </h3>
                                    <h4 v-if="item.link" class="text-base text-gray-700 font-medium break-words">
                                        {{ item.link.substring(0, 50) }}
                                    </h4>
                                    <div v-html="item.details" class="overflow-hidden"
                                        style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">
                                    </div> -->
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
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" id="title" v-model="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter Title" required />
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Description
                        </label>
                        <quill-editor v-model="details" ref="myQuillEditor" :options="editor_options">
                        </quill-editor>
                    </div>
                    <div class="mb-6">
                        <label for="type"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category" v-model="category_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="0">Select category</option>
                            <option v-for="category in categoriesItems" :value="category.id" :key="category.id">
                                {{ category.name }}
                            </option>
                        </select>

                    </div>
                    <!-- <div class="mb-6">
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
                            <option value="Speaker">Speaker</option>
                        </select>
                    </div> -->

                    <div v-if="oldImageFile">
                        <div v-if="oldImageFile && (type === 'Images' || type === 'Speaker' || type === 'URLs' || type === 'Video (YouTube)' || type === 'Social links')"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <img :src="oldImageFile" alt="" class="w-1/2 mx-auto object-cover">
                        </div>
                        <div v-else-if="oldImageFile && (type === 'PDF' || type === 'URLs' || type === 'Video (YouTube)' || type === 'Social links')"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class='embed-responsive h-full'>
                                <embed :src="oldImageFile" type="application/pdf" width="100%" height="100%" />
                            </div>
                        </div>
                        <div v-else-if="oldImageFile && (type === 'Documents (word, ppt, excel)' || type === 'URLs' || type === 'Video (YouTube)' || type === 'Social links')"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col gap-3 justify-center items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 mt-6">
                        <label for="#" class="text-sm text-gray-600 block mb-1 font-semibold">Choose
                            Banner</label>

                        <div class="flex items-center justify-center w-full">

                            <div v-if="uploading">
                                <p>Uploading...</p>
                                <progress :value="progress" max="100"></progress>
                                <p>{{ progress }}%</p>
                            </div>
                            <div v-if="contentPreview && (type === 'Images' || type === 'Speaker' || type === 'URLs' || type === 'Video (YouTube)' || type === 'Social links')"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <img :src="contentPreview" alt="" class="w-1/2 mx-auto object-cover">
                            </div>
                            <div v-else-if="contentPreview && (type === 'PDF' || type === 'URLs' || type === 'Video (YouTube)' || type === 'Social links')"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class='embed-responsive h-full'>
                                    <embed :src="contentPreview" type="application/pdf" width="100%" height="100%" />
                                </div>
                            </div>
                            <div v-else-if="contentPreview && (type === 'Documents (word, ppt, excel)' || type === 'URLs' || type === 'Video (YouTube)' || type === 'Social links')"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col gap-3 justify-center items-center text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>

                                    <p class="text-2xl text-gray-700 capitalize">document uploaded successfully</p>
                                </div>
                            </div>


                            <label for="file"
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
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Allowed types:
                                        {{ acceptedTypes }}</p>
                                </div>
                                <input id="file" type="file" class="hidden" @change="handleContentFileChange" />
                            </label>
                        </div>
                        <p class="text-red-500" v-if="fileTypeError">{{ fileTypeError }}</p>


                    </div>

                    <div class="mb-6" v-if="type === 'Speaker'">
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                        <input type="date" id="title" v-model="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter Date" required />
                    </div>

                    <div class="mb-6" v-if="type === 'Speaker'">
                        <label for="position"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                        <input type="position" id="position" v-model="position"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter position" required />
                    </div>
                    <div class="mb-6" v-if="Object.keys(oldFileRecords).length > 0">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Previous Boucher Files:
                        </label>
                        <div>
                            <ul>
                                <li v-for="(url, key) in oldFileRecords" :key="key"
                                    class="flex justify-between items-center text-base font-medium text-gray-900 list-disc ">
                                    {{ key }}
                                    <span class="cursor-pointer" @click="removePrevBoucherFile(url, key, id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-6">


                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Boucher
                        </label>

                        <div class="">

                            <VueFileAgent ref="vueFileAgent" :theme="'list'" :multiple="true" :deletable="true"
                                :meta="true" :accept="'.doc,.docx,.ppt,.pdf'" :maxSize="'30MB'" :maxFiles="5"
                                :helpText="'Only doc, ppt and pdf file allowed, Maximum : 30MB'"
                                :errorText="{ type: 'Invalid file type. Only doc, ppt and pdf file allowed', size: 'Files should not exceed 30MB in size', }"
                                @select="filesSelected($event)" @beforedelete="onBeforeDelete($event)"
                                @delete="fileDeleted($event)" v-model="fileRecords"></VueFileAgent>
                        </div>


                    </div>
                    <div class="mb-6">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" id="email" v-model="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter email address" required />
                    </div>
                    <div class="mb-6">
                        <label for="phone"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                        <input type="text" id="phone" v-model="phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter phone number" required />
                    </div>

                    <div class="mb-6">
                        <label for="facebook"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Facebook</label>
                        <input type="text" id="facebook" v-model="facebook"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter facebook link" required />
                    </div>
                    <div class="mb-6">
                        <label for="twitter"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Twitter</label>
                        <input type="text" id="twitter" v-model="twitter"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter twitter link" required />
                    </div>
                    <div class="mb-6">
                        <label for="linkedin"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Linkedin</label>
                        <input type="text" id="linkedin" v-model="linkedin"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter linkedin link" required />
                    </div>
                    <div class="mb-6">
                        <label for="instagram"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instagram</label>
                        <input type="text" id="instagram" v-model="instagram"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter instagram link" required />
                    </div>

                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <label class="block mb-2 text-12 text-stromgreay">
                                Videos
                            </label>
                            <label class="block mb-2 text-xs text-brand cursor-pointer font-semibold"
                                @click="addVideoLink">
                                ADD VIDEO LINK
                            </label>
                        </div>
                        <div v-for="(video, index) in videos" :key="index" class="mb-4">
                            <div class="flex justify-between items-center relative">
                                <input type="text" v-model="video.videos_link"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Enter YouTube Video Link" required />
                                <button v-if="videos.length > 1" @click="removeVideoLink(index)"
                                    class=" absolute -right-1 -top-1 w-5 h-5 rounded-full bg-red-600 flex justify-center items-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <button type="button" @click="uploadContentFiles" v-if="!isUpdate"
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
                        <button type="button" @click="updateContentFiles()" v-if="isUpdate"
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
import VLazyImage from "v-lazy-image";
import { Drag, Drop } from 'vue-drag-drop';

import VueDocPreview from 'vue-doc-preview'
import { quillEditor } from 'vue-quill-editor'

export default {
    props: ['contentItems', 'categoriesItems'],
    components: {
        VLazyImage,
        Drag, Drop,
        VueDocPreview,
        quillEditor
    },
    data() {
        return {
            editor_options: {
                modules: {
                    'toolbar': [
                        [{ 'size': [] }],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'script': 'super' }, { 'script': 'sub' }],
                        [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }, { 'align': [] }],
                        ['link', 'image', 'formula'],
                        ['clean']
                    ],
                },
            },
            is_dragging: false,
            isUpdate: false,
            over: false,
            drag: false,

            // contentItems: [],
            // categoriesItems: [],
            selectedTab: 'bio',
            showModal: '',


            isLoading: false,
            isOpenTool: null,

            id: null,
            category_id: '0', // Store the title input value
            title: '', // Store the title input value
            link: '', // Store the link input value
            type: 'Images', // Store the type input value
            contentFile: null, // Store the selected file
            oldImageFile: null, // Store the selected file
            contentPreview: null,
            acceptedTypes: 'Any', // Default accepted types
            acceptedExtensions: '',
            bioTitle: '',
            bioDesc: '',
            details: '',
            date: null,
            position: '',
            facebook: '',
            twitter: '',
            linkedin: '',
            instagram: '',
            updatedId: null,
            current_index: null,
            email: '',
            phone: '',
            videos: [
                { videos_link: '' }
            ],

            uploading: false,
            progress: 0,

            tempAttachments: [],
            attachments: [],

            fileTypeError: '',
            fileRecords: [],
            oldFileRecords: [],
            fileRecord: [],
            boucher_files: [],
            boucher_files1: [],
            boucher_files2: [],
            boucher_files3: [],
            boucher_files4: [],

            fileRecordsForUpload: [],
            uploadUrl: '/api/upload/form_file',
            uploadHeaders: { 'X-Test-Header': 'vue-file-agent' },
        }
    },
    async mounted() {
        // await this.getContentData()
        // await this.getCategoriesData()



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
                case 'Speaker':
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

            axios.post('/api/content/update/order', { contents: this.contentItems })
                .then(res => {

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

        },

        handleContentFileChange(event) {
            const file = event.target.files[0];


            const allowedTypes = {
                'PDF': 'application/pdf',
                'Documents (word, ppt, excel)': [
                    'application/msword',
                    'application/vnd.ms-powerpoint',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' // Add DOCX MIME type
                ],
                'Images': ['image/jpeg', 'image/png', 'image/gif'],
                'Speaker': ['image/jpeg', 'image/png', 'image/gif'],

            };

            const selectedType = this.type;
            const allowedType = allowedTypes[selectedType];



            // Check if the selected type requires validation
            if (selectedType !== 'Video (YouTube)' && selectedType !== 'URLs' && selectedType !== 'Social links') {
                if (Array.isArray(allowedType) && !allowedType.includes(file.type)) {
                    this.fileTypeError = `Only ${allowedType.join(', ')} files are allowed for ${selectedType}.`;
                    return;
                }

                if (!Array.isArray(allowedType) && file.type !== allowedType) {
                    this.fileTypeError = `Only ${allowedType} files are allowed for ${selectedType}.`;
                    return;
                }
            }

            // Reset error message if file type is valid
            this.fileTypeError = '';
            this.uploading = true;
            const reader = new FileReader();

            reader.onload = () => {

                const interval = setInterval(() => {
                    this.progress += 5; // Increment progress by 5%
                    if (this.progress >= 100) {
                        clearInterval(interval);
                        this.contentPreview = reader.result;
                        this.uploading = false;
                    }
                }, 500);
                // Set previewImage to base64 string
            };




            reader.readAsDataURL(file);
            this.contentFile = file;
        }
        ,
        validateFacebook() {
            return this.facebook.includes('facebook.com');
        },
        validateTwitter() {
            return this.twitter.includes('twitter.com');
        },
        validateLinkedIn() {
            return this.linkedin.includes('linkedin.com');
        },
        validateInstagram() {
            return this.instagram.includes('instagram.com');
        },
        async uploadContentFiles() {
            try {
                // Assign files if they exist
                this.boucher_files = this.fileRecordsForUpload[0]?.file;
                this.boucher_files1 = this.fileRecordsForUpload[1]?.file;
                this.boucher_files2 = this.fileRecordsForUpload[2]?.file;
                this.boucher_files3 = this.fileRecordsForUpload[3]?.file;
                this.boucher_files4 = this.fileRecordsForUpload[4]?.file;
                const isFacebookValid = this.validateFacebook();
                const isTwitterValid = this.validateTwitter();
                const isLinkedInValid = this.validateLinkedIn();
                const isInstagramValid = this.validateInstagram();

                if (this.type === "Speaker") {
                    if (this.title === "" || this.date === "" || this.details === "" || this.contentFile === null || this.position === "") {
                        this.$toasted.show("Please fill up all fields", {
                            theme: "toasted-primary",
                            position: "top-center",
                            duration: 5000
                        });
                        return false;
                    }
                } else if (this.title === "" || this.category_id === "0" || this.details === '') {
                    this.$toasted.show("Please fill up required fields", {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration: 5000
                    });
                    return false;
                } else if (!isFacebookValid || !isTwitterValid || !isLinkedInValid || !isInstagramValid) {
                    this.$toasted.show("Please fill up all fields correctly", {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration: 5000
                    });
                    return false;
                } else {
                    const socialLinks = {
                        facebook: this.facebook,
                        twitter: this.twitter,
                        linkedin: this.linkedin,
                        instagram: this.instagram,
                    };
                    const getInTouch = {
                        email: this.email,
                        phone: this.phone
                    };


                    // Create FormData and append all data
                    this.isLoading = true;
                    let formData = new FormData();
                    formData.append('title', this.title);
                    formData.append('category_id', this.category_id);
                    formData.append('type', this.type);
                    formData.append('date', this.date);
                    formData.append('details', this.details);
                    formData.append('position', this.position);
                    formData.append('file', this.contentFile);

                    // Conditionally append each boucher file if it exists
                    if (this.boucher_files) formData.append('boucher_files', this.boucher_files);
                    if (this.boucher_files1) formData.append('boucher_files1', this.boucher_files1);
                    if (this.boucher_files2) formData.append('boucher_files2', this.boucher_files2);
                    if (this.boucher_files3) formData.append('boucher_files3', this.boucher_files3);
                    if (this.boucher_files4) formData.append('boucher_files4', this.boucher_files4);

                    formData.append('social_links', JSON.stringify(socialLinks));
                    formData.append('get_in_touch', JSON.stringify(getInTouch));
                    formData.append('videos_link', JSON.stringify(this.videos));

                    // Make POST request to upload the file and data
                    const response = await axios.post('/api/content', formData);

                    if (response.status === 200) {
                        // Handle success
                        this.contentItems.push(response.data.data);

                        // this.getContentData(); // Update content data
                        this.showModal = false; // Close the modal after successful upload

                        // Reset all data
                        this.title = '';
                        this.link = '';
                        this.date = '';
                        this.details = '';
                        this.position = '';
                        this.category_id = '0';
                        this.type = 'Select Type';
                        this.contentFile = null;
                        this.contentPreview = null;
                        this.facebook = '';
                        this.twitter = '';
                        this.linkedin = '';
                        this.instagram = '';
                        this.phone = '';
                        this.email = '';

                        this.fileRecords = [];
                        this.isLoading = false;

                        this.$toasted.success(response.data.message, {
                            theme: "toasted-primary",
                            position: "top-center",
                            duration: 5000
                        });
                    }
                }
            } catch (error) {
                console.error(error);
                this.$toasted.show("An error occurred. Please try again.", {
                    theme: "toasted-primary",
                    position: "top-center",
                    duration: 5000
                });
            }


        },
        uploadFiles() {
            // Using the default uploader. You may use another uploader instead.
            this.$refs.vueFileAgent.upload(this.uploadUrl, this.uploadHeaders, this.fileRecordsForUpload);
            this.fileRecordsForUpload = [];
        },
        deleteUploadedFile(fileRecord) {
            // Using the default uploader. You may use another uploader instead.
            this.$refs.vueFileAgent.deleteUpload(this.uploadUrl, this.uploadHeaders, fileRecord);
        },
        filesSelected(fileRecordsNewlySelected) {

            var validFileRecords = fileRecordsNewlySelected.filter((fileRecord) => !fileRecord.error);
            this.fileRecordsForUpload = this.fileRecordsForUpload.concat(validFileRecords);
        },
        onBeforeDelete(fileRecord) {
            var i = this.fileRecordsForUpload.indexOf(fileRecord);
            if (i !== -1) {
                // queued file, not yet uploaded. Just remove from the arrays
                this.fileRecordsForUpload.splice(i, 1);
                var k = this.fileRecords.indexOf(fileRecord);
                if (k !== -1) this.fileRecords.splice(k, 1);
            } else {
                if (confirm('Are you sure you want to delete?')) {
                    this.$refs.vueFileAgent.deleteFileRecord(fileRecord); // will trigger 'delete' event
                }
            }
        },
        fileDeleted(fileRecord) {
            var i = this.fileRecordsForUpload.indexOf(fileRecord);
            if (i !== -1) {
                this.fileRecordsForUpload.splice(i, 1);
            } else {
                this.deleteUploadedFile(fileRecord);
            }
        },

        async removePrevBoucherFile(url, key, id) {
            try {
                const response = await axios.delete('/api/content/remove/boucher-file', {
                    data: {
                        id: id,
                        key: key,
                        url: url
                    }
                });

                if (response.status === 200) {
                    // Show a toast message on success
                    this.$toasted.show(response.data.message, {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration: 5000
                    });

                    // Remove the item from the boucher_files object
                    this.$delete(this.oldFileRecords, key);
                }
            } catch (error) {
                console.error("Error deleting resource:", error);
                // Handle error if needed
            }
        },
        deleteContentItem(id, index) {
            axios.delete(`/api/content/${id}`)
                .then(response => {
                    this.$delete(this.contentItems, index);
                })
                .catch(error => {
                    console.error('Error deleting resource:', error);
                    // Handle error if needed
                });
        },
        UpdateContent(item, index) {

            const get_in_touch_decode = JSON.parse(item.get_in_touch)
            const social_links_decode = JSON.parse(item.social_links)
            const boucher_files_decode = JSON.parse(item.boucher_files)
            const videos_link = JSON.parse(item.videos_link)

            console.log(item)

            this.current_index = index
            this.updatedId = item.id
            this.showModal = 'pdf';
            this.isUpdate = true
            this.title = item.title;
            this.link = item.link;
            this.date = item.date;
            this.details = item.details;
            this.position = item.position;
            this.type = item.type;
            // this.contentFile = item.file;
            // this.contentPreview = item.file;
            this.email = get_in_touch_decode.email;
            this.phone = get_in_touch_decode.phone;
            this.facebook = social_links_decode.facebook;
            this.twitter = social_links_decode.twitter;
            this.linkedin = social_links_decode.linkedin;
            this.instagram = social_links_decode.instagram;
            this.oldFileRecords = boucher_files_decode;
            this.oldImageFile = item.file;
            this.category_id = item.category_id
            this.id = item.id
            this.videos = videos_link===null?[]:videos_link
        },
        async updateContentFiles() {
            try {
                const isFacebookValid = this.validateFacebook();
                const isTwitterValid = this.validateTwitter();
                const isLinkedInValid = this.validateLinkedIn();
                const isInstagramValid = this.validateInstagram();



                if (this.type === "Speaker") {
                    if (this.title === "" || this.date === "" || this.details === "" || this.contentFile === null || this.position === "") {
                        this.$toasted.show("Please fill up all fields", {
                            theme: "toasted-primary",
                            position: "top-center",
                            duration: 5000
                        });
                        return false;
                    }
                } else if (this.title === "" || this.category_id === "0" || this.details === '') {
                    this.$toasted.show("Please fill up required fields", {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration: 5000
                    });
                    return false;
                } else if (!isFacebookValid || !isTwitterValid || !isLinkedInValid || !isInstagramValid) {
                    this.$toasted.show("Please fill up all fields correctly", {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration: 5000
                    });
                } else {

                    this.isLoading = true;
                    let formData = new FormData();
                    if (this.title) {
                        formData.append('title', this.title);
                    }
                    if (this.link) {
                        formData.append('link', this.link);
                    }
                    if (this.type) {
                        formData.append('type', this.type);
                    }
                    if (this.date) {
                        formData.append('date', this.date);
                    }
                    if (this.details) {
                        formData.append('details', this.details);
                    }
                    if (this.position) {
                        formData.append('position', this.position);
                    }

                    formData.append('category_id', this.category_id);

                    const getInTuch = {
                        email: this.email,
                        phone: this.phone
                    }
                    formData.append('get_in_touch', JSON.stringify(getInTuch));

                    const socialLinks = {
                        facebook: this.facebook,
                        twitter: this.twitter,
                        linkedin: this.linkedin,
                        instagram: this.instagram,
                    };
                    formData.append('social_links', JSON.stringify(socialLinks));
                    formData.append('videos_link', JSON.stringify(this.videos));

                    this.boucher_files = this.fileRecordsForUpload[0]?.file;
                    this.boucher_files1 = this.fileRecordsForUpload[1]?.file;
                    this.boucher_files2 = this.fileRecordsForUpload[2]?.file;
                    this.boucher_files3 = this.fileRecordsForUpload[3]?.file;
                    this.boucher_files4 = this.fileRecordsForUpload[4]?.file;

                    if (this.boucher_files) formData.append('boucher_files', this.boucher_files);
                    if (this.boucher_files1) formData.append('boucher_files1', this.boucher_files1);
                    if (this.boucher_files2) formData.append('boucher_files2', this.boucher_files2);
                    if (this.boucher_files3) formData.append('boucher_files3', this.boucher_files3);
                    if (this.boucher_files4) formData.append('boucher_files4', this.boucher_files4);
                    if (this.contentFile) {
                        formData.append('file', this.contentFile);
                    }
                    // if (this.contentFile) {
                    //     const fileName = this.extractFileName(this.contentFile);
                    //     await this.urlToFile(this.contentFile, fileName, (file) => {
                    //         formData.append('file', file);
                    //     });
                    // }

                    const response = await axios.post(`/api/content/${this.updatedId}`, formData);

                    if (response.status === 200) {
                        // Handle success
                        this.$set(this.contentItems, this.current_index, response.data.data);
                        this.showModal = false;
                        // Reset all data
                        this.title = '';
                        this.link = '';
                        this.date = '';
                        this.details = '';
                        this.position = '';

                        this.type = 'Select Type';
                        this.contentFile = null;
                        this.contentPreview = null;
                        this.isLoading = false;
                        this.$toasted.success(response.data.message, {
                            theme: "toasted-primary",
                            position: "top-center",
                            duration: 5000
                        });
                    }
                }

            } catch (error) {
                // Handle error
                console.error("Error:", error);
                this.isLoading = false;
                // Add specific error handling as needed
            }
        },
        extractFileName(url) {
            return url.split('/').pop().split('#')[0].split('?')[0];
        },
        urlToFile(url, fileName, callback) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.responseType = 'blob';
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const file = new File([xhr.response], fileName, { type: xhr.response.type });
                    callback(file);
                }
            };
            xhr.send();
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
        },
        addVideoLink() {
            this.videos.push({ videos_link: '' });
        },
        removeVideoLink(index) {
            if (this.videos.length > 1) {
                this.videos.splice(index, 1);
            }
        },

    },
}
</script>

<style>
.ql-container.ql-snow {
    min-height: 200px;
}

.is_dragging {
    overflow: hidden;
    border: 1px dotted #9A5626 !important;
}

.vue-file-agent .file-input {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    z-index: 10;
    cursor: pointer;
}
</style>
