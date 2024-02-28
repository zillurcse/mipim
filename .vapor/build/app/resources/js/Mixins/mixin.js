import axios from "axios";

export default{
    data(){
        return{

            base_url:window.location.origin,
            img_src:'',
            img_src_local:'',
            post_url:null,
            get_url:null,
            general_url:null,
            formData:{},
            inputData:{},
            imageUrl:'',
            dataList:{},
            searchForm:{},
            form_title:'',
            has_file:false,
            is_hiddenbar:false,
            show_tab:'',
            is_tools:false,
            is_edit_mode:false,
            reloadKey:0,

            previewImgSize:'',
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
                        ['link', 'image', 'video', 'formula'],
                        ['clean']
                    ],
                },
            },
            image_height:200,
            image_width:200,
            update_image:'',
            show_image_chooser:false,
            show_cancle_warning_popup:true,
            is_typed:false,
            current_editing:-1,
            open_tool:-1,
            should_reload:false,
            should_hide_sidebar:true,
        }
    },
    created(){
        // this.img_src = this.base_url+'/bcknd/src/assets/img/';
        this.img_src = 'https://d30komtae77sjh.cloudfront.net/bcknd/src/assets/img/';
        this.img_src_local = '/bcknd/src/assets/img/';
        this.dataList = this.items
    },

    watch:{
        // dataList:function(current, old){

        //     this.dataList = current
        // }

    },

    mounted(){

    },

    components:{

    },
    methods:{
        typedSomething(){
            this.$emit('is_typed')
        },
        updateUpdateImage(image){
            this.is_typed = true;

            this.update_image = image;

        },
        openImagePicker(w, h){
            this.image_height = h;
            this.image_width = w;
            this.show_image_chooser = true;
        },
        toastMessage(type, message, icon, position, actionIcon){
            var toast = null;
            if(type == 'success'){
                toast = this.$toasted.success
            } else if(type == 'info'){
                toast = this.$toasted.info
            } else if(type == 'error'){
                toast = this.$toasted.error
            } else {

            }
            toast(message, {
                // theme:'bubble',
                position:position?position:'top-right',
                iconPack:'fontawesome',
                icon:icon?icon:'check',
                duration:2000,
                action: {
                    icon: actionIcon?actionIcon:'times',
                    class:'text-white',
                    onClick: (e, toastObject) => {
                        toastObject.goAway(0);
                    }
                },
            });
        },
        getDataList(page = 1){
            let path = this.general_url != null?this.general_url:this.get_url

            let search = "";

            if((this.searchForm.search && this.searchForm.search != 'undefined')){

                search = this.searchForm.search

            } else {

                search = false

            }

            let sorting_item = ""

            // if(this.sortingForm.sorting_item && this.sortingForm.sorting_item != 'undefined'){

            //     sorting_item = this.sortingForm.sorting_item
            //     page = (sorting_item - sorting_item) + 1

            // } else {

            //     sorting_item = false

            // }




            let api_path = this.base_url+path+'?page='+page+'&search='+search+'&sorting='+sorting_item

            axios.get(api_path)
                .then(response => {

                    if(response.status == 200){

                        this.dataList = response.data


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

        save() {
            this.show_cancle_warning_popup = false;
            let form = document.getElementById("data-form");
            let dataWithFile = new FormData($(form)[0]);
            let data = this.has_file == true?dataWithFile:this.formData
            let path = this.general_url != null?this.general_url:this.post_url
            axios.post(path, data)
                .then(res => {
                    this.toastMessage('success', res.data.message);
                    if (this.items){
                        if (res.data.data){
                            this.items.push(res.data.data)
                        }
                    }

                    if (this.should_reload){
                        location.reload();
                    }
                    //this.$emit('created', );
                    this.closeHiddenbar()

                    //this.reloadPage()
                })
                .catch(error =>{
                    if(error.response.status == 422){
                        this.error = error.response.data.errors
                        $.each(error.response.data.errors, function(item,index){
                            let input = jQuery(document).find('input[name="'+item+'"]')
                            let inputAfter = jQuery(document).find('input[name="'+item+'"] + span')
                            input.addClass('is-invalid');
                            inputAfter.remove()
                            input.after('<span class="text-danger text-14">'+error.response.data.errors[item]+'</span>')

                        })
                    }
                })
        },
        edit(data,index=-1) {
            // this.editData = Object.assign({}, data);

            this.is_hiddenbar = true;
            this.show_tab = 'tab';
            this.is_edit_mode = true;
            this.formData     = data;
            this.current_editing = index;
            this.closeTools(data.id);
            // this.open_tool = -1;

            this.previewImgSize = "";

            setTimeout(() => {
                let imageWidth = $('.changeimage').width()
                let imageHeight = $('.changeimage').height()

                this.previewImgSize = 'width:'+imageWidth+'px; height:'+imageHeight+'px;'

            }, 1000);
            this.closeTools(data.id);


        },
        change_details(){

            this.is_loading = !this.is_loading;
            let form = document.getElementById("data-form")
            let dataWithFile = new FormData($(form)[0])
            let data_collection = this.has_file == true?dataWithFile:this.formData

            if(this.has_file == true){

                data_collection.append('_method', 'PUT')

            } else {

                data_collection._method = 'PUT'

            }

            // return false

            let path = this.general_url != null?this.general_url:this.post_url

            axios.post(path +'/'+ this.formData.id, data_collection)
                .then(res=>{
                    this.toastMessage('success', res.data.message)

                    this.closeHiddenbar()
                    ////this.reloadPage()
                })
            // this.$confirm(
            //     {
            //         title: 'Are you sure?',
            //         message: 'Do you really want to leave? you have unsaved changes!',
            //         button: {
            //             no: 'Cancel',
            //             yes: 'Update'
            //         },
            //         /**
            //          * Callback Function
            //          * @param {Boolean} confirm
            //          */
            //         callback: confirm => {
            //             if (confirm) {
            //
            //
            //             }
            //         }
            //     }
            // )
        },
        update() {
            // if (!confirm('Sure')) return;
            this.show_cancle_warning_popup = false;
            let form = document.getElementById("data-form");
            let dataWithFile = new FormData($(form)[0])
            let data_collection = this.has_file == true?dataWithFile:this.formData;

            if(this.has_file == true){
                data_collection.append('_method', 'PUT')
            } else {
                data_collection._method = 'PUT'
            }
            // return false

            let path = this.general_url != null?this.general_url:this.post_url;
            axios.post(path +'/'+ this.formData.id, data_collection)
                .then(res=>{
                    //this.toastMessage('success', res.data.message);
                    this.$toasted.show(res.data.message, {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration : 5000
                    });
                    if (this.current_editing != -1){
                        if (this.items){
                            if (res.data.data){
                                this.items[this.current_editing]=res.data.data;
                                this.current_editing = -1;
                            }
                        }
                    }

                    if (this.should_reload){
                        location.reload();
                    }
                    if (this.should_hide_sidebar){
                        this.closeHiddenbar()
                    }

                    //this.reloadPage()
                });


        },
        activeItem(item){
            this.closeTools(item.id);
            // if (!confirm('Sure')) return;
            let obj =  Object.assign({}, item)
            obj._method = 'PUT'
            obj.status = 'active'

            let path = this.general_url != null?this.general_url:this.post_url;
            axios.post(path +'/'+ obj.id, obj)
                .then(res => {
                    this.toastMessage('success', res.data.message)

                    //this.reloadPage()
                })
        },
        dialogConfig(msg){
            let message = msg;

            let options = {
                html: false, // set to true if your message contains HTML tags. eg: "Delete <b>Foo</b> ?"
                loader: false, // set to true if you want the dailog to show a loader after click on "proceed"
                reverse: false, // switch the button positions (left to right, and vise versa)
                okText: 'Yes',
                cancelText: 'No',
                animation: 'bounce', // Available: "zoom", "bounce", "fade"
                type: 'basic', // coming soon: 'soft', 'hard'
                verification: 'continue', // for hard confirm, user will be prompted to type this to enable the proceed button
                verificationHelp: 'Type "[+:verification]" below to confirm', // Verification help text. [+:verification] will be matched with 'options.verification' (i.e 'Type "continue" below to confirm')
                clicksCount: 3, // for soft confirm, user will be asked to click on "proceed" btn 3 times before actually proceeding
                backdropClose: false, // set to true to close the dialog when clicking outside of the dialog window, i.e. click landing on the mask
                customClass: '' // Custom class to be injected into the parent node for the current dialog instance
            };

            let config = {
                message:message,
                options:options
            }

            return config


        },
        deleteRow(item, index = -1, is_array=false) {

            let msg = 'Are you sure you want to delete this item?';
            // let message = this.dialogConfig(msg).message
            // let options = this.dialogConfig(msg).options;
            this.closeTools(item.id);
            this.$confirm({
                    title: msg,
                    button: {
                        no: 'Cancel',
                        yes: 'Delete'
                    },
                    /**
                     * Callback Function
                     * @param {Boolean} confirm
                     */
                    callback: confirm => {
                        if (confirm) {
                            let obj =  Object.assign({}, item)
                            obj._method = 'DELETE'
                            let path = this.general_url != null?this.general_url:this.post_url

                            axios.post(path +'/'+ obj.id, obj)
                                .then(res => {
                                    this.toastMessage('success', res.data.message)
                                    if (is_array){
                                        if (index != -1){
                                            this.$delete(this.items, index)
                                        }

                                    }
                                    //this.reloadPage()

                                })
                        }else {
                            return;
                        }
                    }
                }
            )
            // this.$dialog.confirm(message, options)
            //     .then(res => {
            //
            //
            //     })
            //     .catch(error => {
            //         this.toastMessage('success', 'Thanks for keeping me safe!')
            //     });

        },
        getChildInfo(value){
            if(value == 'yes'){

                this.is_hiddenbar = false;
                this.show_tab = '';

                location.reload(function(){
                    setInterval(()=>{
                        let messageDiv = document.getElementById('#closeMessage')
                        $(messageDiv).hide()
                    },1000)
                })

            }
        },
        cropImgPreview(img_url){
            let getPathName = window.location.pathname  // Default2.aspx
            let split_PathName = getPathName.split("/");

            let is_setting = split_PathName.includes('settings');
            let is_engagement = split_PathName.includes('eventengagment');

            let is_details = split_PathName.includes('details');

            switch (split_PathName[5]) {
                case 'logo':
                    this.is_edit_mode?this.formData.logo = img_url:imageUrl = img_url
                    break;
                case 'website-banner':
                    this.is_edit_mode?this.formData.image = img_url:imageUrl = img_url
                    break;
                case 'community-banner':
                    this.is_edit_mode?this.formData.image = img_url:imageUrl = img_url
                    break;
                case 'app-banner':
                    this.is_edit_mode?this.formData.image = img_url:imageUrl = img_url
                    break;
                case 'image-gallery':
                    this.is_edit_mode?this.formData.image = img_url:imageUrl = img_url
                    break;

                case 'speakers':
                    this.is_edit_mode?this.formData.image = img_url:imageUrl = img_url
                    break;

                default:

                    break;
            }


        },
        handleUploaded(resp) {

            this.imageUrl = resp

            let imageWidth = $('.changeimage').width()
            let imageHeight = $('.changeimage').height()

            this.previewImgSize = 'width:'+imageWidth+'px; height:'+imageHeight+'px;'
            this.cropImgPreview(resp)
        },
        initValues(){
            this.componentKey += 1;
        },
        selectNewPhoto() {
            this.$refs.photo.click();
        },
        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;

            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },

        reloadPage(){
            setTimeout(() => {
                location.reload()
            }, 500)
        },

        openFile(e){

            jQuery('#open_file').trigger('click')


        },

        previewImage(event, serial){

            let previewId= 'preview_'+serial
            var output = document.getElementById(previewId)

            output.src = URL.createObjectURL(event.target.files[0]);


            var target = event.target.currentTarget
            $(target).prev().text("")
            $(target).prev().text("Change Image")


            let imageWidth = $('.changeimage').width()
            let imageHeight = $('.changeimage').height()

            this.previewImgSize = 'width:'+imageWidth+'px; height:'+imageHeight+'px;'


        },

        openTools(id){
            let toolId = document.getElementById(id+'isTools');
            $(toolId).hide()
            $(toolId).show()

        },
        clickTool(id){
            if (this.open_tool == id){
                this.open_tool = -1
            }else {
                this.open_tool = id;
            }
        },
        closeCTool(){
            // console.log('ok');
            if (this.open_tool == id){
                this.open_tool = -1
            }else {
                this.open_tool = id;
            }
        },

        closeTools(id){
            let toolId = document.getElementById(id+'isTools');
            $(toolId).hide()
            // this.is_edit_mode = false

        },

        openHiddenbar() {
            this.previewImgSize = 'width: 46px; height: 46px;'
            this.is_edit_mode = false;
            this.is_hiddenbar = true;
            this.show_tab = 'tab';
            this.resetForm()
        },

        closeHiddenbar() {
            //console.log(this.is_typed);

            this.is_typed = false;
            this.show_cancle_warning_popup = true;
            this.previewImgSize = 'width: 46px; height: 46px;';
            this.is_hiddenbar = false;
            this.show_tab = '';
            this.formData = {}
            this.update_image = '';
            // if (this.is_typed && this.show_cancle_warning_popup){
            //     this.$confirm(
            //         {
            //             title: 'Are you sure you want to close?',
            //             button: {
            //                 no: 'No',
            //                 yes: 'Yes'
            //             },
            //             /**
            //              * Callback Function
            //              * @param {Boolean} confirm
            //              */
            //             callback: confirm => {
            //                 if (confirm) {
            //                     this.is_typed = false;
            //                     this.show_cancle_warning_popup = true;
            //                     this.previewImgSize = 'width: 46px; height: 46px;'
            //                     this.is_hiddenbar = false;
            //                     this.show_tab = '';
            //                     this.formData = {};
            //                     this.update_image = '';
            //
            //                 }else {
            //                     return;
            //                 }
            //             }
            //         }
            //     )
            // }else {
            //     this.is_typed = false;
            //     this.show_cancle_warning_popup = true;
            //     this.previewImgSize = 'width: 46px; height: 46px;';
            //     this.is_hiddenbar = false;
            //     this.show_tab = '';
            //     this.formData = {}
            //     this.update_image = '';
            // }


        },

        showHiddenbar(){

            $(document).ready(function(){
                $('#is_meeting_tab_active').show()
            })

        },

        hideHiddenbar(){
            $(document).ready(function(){
                $('#is_meeting_tab_active').hide()

            })
        },

        resetForm(){
            let formId = document.getElementById('data-form')
            $(formId).trigger("reset")
        },

    }
}
