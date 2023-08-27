<template>

   

</template>
<script>
import vueFilePond, {setOptions} from 'vue-filepond';
import "filepond/dist/filepond.min.css";
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';

// Import the plugin code
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

// Import the plugin styles
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

// Import the plugin code
import FilePondPluginImageTransform from 'filepond-plugin-image-transform';


// Import the plugin code
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';



let serverMessage = {};

setOptions({

    server:{
        process: {
            url:'./upload',
            onerror:(response) => {
                serverMessage = JSON.parse(response)
            },
            ondata: (formData) => {
                formData.append('model', 'gallery');
                formData.append('model_id', '1');
                return formData;
            },
            headers: {
                'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf_token"]').content,
            }
        }
    },
    labelFileProcessingError:() =>
    {
        return serverMessage.error;
    }
});

const FilePond = vueFilePond(FilePondPluginFileValidateType,FilePondPluginFileValidateSize,FilePondPluginImageTransform);

export default{
    components:{
        FilePond
    },
    data(){
        return {
            images:[]
        }
    },
    props:{
        model_id:{
            type:Number,
            required:true
        }
    },
    created()
    {
        console.log("modelo " + this.model_id)
    },
    mounted(){
        axios.get('/images')
        .then((response) => {
            this.images = response.data;
            console.log(JSON.stringify(this.images,null,4))
        }).catch((error) => {
                console.log(error)
        })
    },
    methods:{
        filepondInitialized()
        {
            console.log("ininciado")
        },
        handleProcessFile(error , file)
        {
            if(error)
            {
                console.error(error);
                return;
            }

            console.log(file)

            //add image to images object
            this.images.unshift(file.serverId)

        }
    }
}
</script>
