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
export default {
    data(){
      return {
        dropzoneOptions: {
            url: 'http://localhost:8000/api/uploads',
            thumbnailWidth: 150,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.jfif",
            addRemoveLinks: true,
            maxFilesize: 3,
            paralleUploaded: 5,
            maxFiles: 5,
            uploadMultiple: true,
        },
        thumbnails: [],
      }
    },
    components: {
        vueDropzone: vue2Dropzone,
    },
    methods: {
        getDataResponse: function (file, response) {
                let data = response.fileNames;
                data.forEach(file=>{
                    this.thumbnails.push(file);
                });
                //  console.log(this.thumbnails);
        },
    }
}
</script>

<style>

</style>
