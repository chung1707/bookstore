<template>
    <div>
        <vue-dropzone
        ref="myVueDropzone"
        id="dropzone"
        :options="dropzoneOptions"
        @vdropzone-success-multiple="getDataResponse"
        ></vue-dropzone>
        <input type="hidden" v-model="thumbnails" name= "thumbnails[]">
    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';

import {mapGetters, mapActions} from 'vuex'
export default {
    computed:{
        ...mapGetters(['thumbnails']),
    },
    data(){
      return {
        dropzoneOptions: {
            url: '/api/uploads',
            thumbnailWidth: 150,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.jfif",
            addRemoveLinks: true,
            maxFilesize: 2,
            paralleUploaded: 5,
            maxFiles: 2 ,
            uploadMultiple: true,
        },
        fileNames: [],
      }
    },
    components: {
        vueDropzone: vue2Dropzone,
    },
    methods: {
        ...mapActions(['setThumbnails']),
        getDataResponse: function (file, response) {
                let data = response.fileNames;
                data.forEach(file=>{
                    this.fileNames.push(file);
                });
                this.setThumbnails(this.fileNames);
        },
    }
}
</script>

<style>

</style>
