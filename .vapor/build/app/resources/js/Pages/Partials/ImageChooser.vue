<template>
    <div style="width: 100%;height: 100vh;position: fixed;top: 0;left: 0;background-color: rgba(0, 0, 0, 0.8);z-index: 99999999;" class="popupi flex justify-center items-center">
        <div class="flex justify-center items-center bg-white rounded-6 overflow-hidden">
            <div class="flex justify-center items-center rounded-6">
                <div class="rounded-6" style="box-shadow: 0px 0px 4px 3px rgba(167, 166, 166, 0.24); width: 700px;">
                    <div class="px-20 pb-10">
                        <div class="pt-20 flex justify-between align-items-center">
                            <div class="space-y-5">
                                <h2 class="text-16 text-capcod font-bold">Select Images for Gallery</h2>
                                <p class="text-14 text-stromgreay">
                                    You can upload any image or choose anyone that you already uploaded to gallery.
                                </p>
                            </div>
                            <div @click.prevent="$emit('close')" class="w-24 h-24 rounded-full bg-white flex justify-center items-center cursor-pointer" style="box-shadow: -3px 4px 10px -8px rgba(0, 0, 0, 0.85);">
                                <img :src="img_src+'cancel-icon.svg'" alt="" class="w-10 h-10" />
                            </div>
                        </div>
                    </div>
                    <div class="px-20 pt-10 pb-20">
                        <div class="flex">
                            <button @click="active_tab = 'upload'" :class="['px-20 py-7 text-12 uppercase font-bold',active_tab=='upload'?'bg-brand text-white':'bg-greaywhite text-stromgreay']" style="border-radius: 6px 0px 0px 6px;">
                                UPLOAD
                            </button>
                            <button @click="active_tab = 'gallery'" :class="['px-20 py-7 text-12 uppercase',active_tab=='gallery'?'bg-brand text-white':'bg-greaywhite text-stromgreay']" style="border-radius: 0px 6px 6px 0px;">
                                GALLERY
                            </button>
                        </div>
                    </div>
                    <div v-if="active_tab == 'upload'"  class="flex w-full justify-center py-50">
                        <avatar-cropper
                            @uploaded="handleUploaded"
                            @uploading="is_uploading = true"
                            trigger="#pick-image"
                            upload-url="/getCroptedImage"
                            :labels="{ submit: 'Crop', cancel: 'Cancel'}"
                            :output-quality="0.9"
                            :output-mime="'image/jpeg'"
                            :output-options="{width: this.width, height: this.height}"
                            :cropper-options="{aspectRatio: this.width/this.height,autoCropArea: 2,viewMode: 1,movable: true,zoomable: false}"
                        />
                        <div v-if="is_uploading" class="flex rounded-6 justify-center w-390 items-center flex-col h-200 border-dotted border-stromgreay border-1 border-opacity-40 cursor-pointer hover_border_input" style="background: #f4f5f7;">
                            <img :src="img_path+'/svgs/meeting/loading.svg'" alt="placeholder" />
                        </div>
                        <div v-else-if="image.length"  class="flex rounded-6 justify-center w-390 items-center flex-col h-200 border-dotted border-stromgreay border-1 border-opacity-40 cursor-pointer hover_border_input" style="background: #f4f5f7;">
                            <div class="w-24 h-24 rounded-full bg-white flex justify-center items-center cursor-pointer" style="box-shadow: -3px 4px 10px -8px rgba(0, 0, 0, 0.85);    position: absolute;" @click.prevent="image=''">
                                <img :src="img_src+'cancel-icon.svg'" alt="" class="w-10 h-10" />
                            </div>
                            <img style="max-width: 100%;max-height: 100%;" :src="$page.app.asset_url+image" alt="placeholder" />
                        </div>
                        <div v-else @click="$refs.pick_image.click()" class="flex rounded-6 justify-center w-390 items-center flex-col h-200 border-dotted border-stromgreay border-1 border-opacity-40 cursor-pointer hover_border_input" style="background: #f4f5f7;">
                            <img :src="img_src+'imageplaceholder.svg'" alt="placeholder" />
                            <p class="text-14 mt-10 text-stromgreay opacity-60 text-center font-bold">Upload a new image </p>
                            <p class="text-12 text-stromgreay opacity-70 text-center">Maximum : 2 MB</p>
                        </div>
                        <button style="display: none" class="" ref="pick_image" id="pick-image"></button>

                    </div>

                    <div v-else class="w-full px-20 py-20">
                        <div class="flex items-center flex-wrap">
                            <div v-for="img in gallery_images" :key="'glry'+img.id" @click="image = img.url" class="relative selectBtn cursor-pointer" style="margin: 2px;border-radius: 10px;align-items: center;display: flex;width: 24%;height: 120px;border: 1px solid gray;">
                                <img :src="$page.app.asset_url+img.url" alt="" style="max-width: 150px!important;max-height: 110px!important;margin: auto;border-radius: 5px" class="" />
                                <div v-if="image == img.url" class="absolute px-3 py-3 rounded-full select displayin" style="background-color: #37af47; border: 1px solid white; bottom: 6px; right: 6px; opacity: 0; visibility: hidden;">
                                    <img :src="img_src+'check.svg'" alt="" class="w-12 h-12" />
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="py-20 px-30" style="background-color: #f4f5f7;">
                        <div class="flex justify-end items-center space-x-10">
                            <div>
                                <button style="padding-top: 7px;" @click.prevent="$emit('close')" type="button" class="w-116 h-35 text-14 font-semibold text-capcod rounded-6">
                                    Cancel
                                </button>
                            </div>
                            <div>

                                <button v-if="image.length" @click.prevent="imageSelected()" type="button" class="w-116 h-35 text-14 font-semibold uppercase bg-brand text-white rounded-6">
                                    Select
                                </button>
                                <button v-else type="button" style="background: rgb(197 198 199)"  class="w-116 h-35 text-14 font-semibold uppercase text-white rounded-6">
                                    Select
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import axios from 'axios';
export default {
    name: "image-chooser",
    props: ['show','height','width'],
    data(){
        return{
            img_path:'https://d30komtae77sjh.cloudfront.net',
            img_src: 'https://d30komtae77sjh.cloudfront.net/bcknd/src/assets/img/',
            image:'',
            active_tab:'upload',
            gallery_images:[],
            is_loading:true,
            is_uploading:false,

        }
    },
    methods:{
        close(){
            this.$emit('close')
        },
        handleUploaded(resp) {
            this.image = resp;
            this.is_uploading = false;
        },
        imageSelected(){
            this.$emit('imageSelected', this.image);
            this.close();
        }
    },
    mounted() {
        axios.post('/api/image-gallery/get')
            .then(res=>{
                this.gallery_images = res.data.data;
                this.is_loading = false;
            })
    }
}
</script>

<style scoped>

</style>
