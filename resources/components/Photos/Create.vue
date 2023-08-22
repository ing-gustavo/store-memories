<template>

    <div class="container  mx-auto pt-2 pb-64" >

        <nav aria-label="Progress" class="bg-white">

            <ol role="list" class="divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0">

                <li class="relative md:flex md:flex-1">
                    <!-- Current Step -->
                    <a href="#" class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">
                        <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-indigo-600">
                        <span class="text-indigo-600">01</span>
                        </span>
                        <span class="ml-4 text-sm font-medium text-indigo-600">Cargar imagenes</span>
                    </a>
                    <!-- Arrow separator for lg screens and up -->
                    <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                        <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                        </svg>
                    </div>
                </li>


                <li class="relative md:flex md:flex-1">
                    <!-- Upcoming Step -->
                    <a href="#" class="group flex items-center">
                        <span class="flex items-center px-6 py-4 text-sm font-medium">
                            <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
                                <span class="text-gray-500 group-hover:text-gray-900">02</span>
                            </span>
                            <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">Correo</span>
                        </span>
                    </a>

                    <!-- Arrow separator for lg screens and up -->
                    <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                        <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                        </svg>
                    </div>
                </li>

                <li class="relative md:flex md:flex-1">
                    <!-- Upcoming Step -->
                    <a href="#" class="group flex items-center">
                        <span class="flex items-center px-6 py-4 text-sm font-medium">
                            <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
                                <span class="text-gray-500 group-hover:text-gray-900">03</span>
                            </span>
                            <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">Confirmación</span>
                        </span>
                    </a>
                </li>
            </ol>
        </nav>


        <div class="flex items-center justify-center">

            <div class="w-full rounded-lg  shadow bg-white">

                <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-end">
                    <button @click="save" :disabled="disableButton" type="button" class="disabled:bg-red-500 rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Continue</button>
                </div>

                <div class="px-4 py-5 sm:p-6">
                    <!-- Content goes here -->
                    <file-pond
                        name="image"
                        ref="pond"
                        label-idle="Click to choose an image, or drag here ... "
                        @init="filepondInitialized"
                        accepted-file-type="image/jpg, image/jpeg, image/png"
                        @processfile="handleProcessFile"
                        credits="false"
                        :allowMultiple="true"
                        max-file-size="50MB"
                        @addfilestart="disableButton = true"
                        @onaddfile="disableButton = false"


                    />
                    <div class="w-full  pb-10 mx-auto mb-10 gap-1  columns-3xs space-y-1">
                        <img  v-for="(image, index) in images" :key="index" :src="image.image_src" class="w-1/4">
                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script>
import vueFilePond, {setOptions} from 'vue-filepond';
import "filepond/dist/filepond.min.css";
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import Axios from 'axios';
let serverMessage = {};

const FilePond = vueFilePond(FilePondPluginFileValidateType,FilePondPluginFileValidateSize);

export default{

    components:{
        FilePond
    },
    data(){
        return {
            images:[],
            isActive: true,
            error: null,
            validationErrors:[],
            disableButton:false
        }
    },
    methods:{
        save()
        {

            console.log(JSON.stringify(this.images,null,4))

            this.validationErrors = null; // Reset errors before making the request

            Axios.post('/photos', {images:this.images})
                .then(response => {
                    // Handle the successful response
                    console.log(response.data.message);
                    location.href = '/photos/'+response.data.id+'/edit';
                })
                .catch(error => {

                    if (error.response && error.response.status === 422) {
                        // If there are validation errors, set the errors property
                        this.validationErrors = error.response.data.errors;
                    } else {
                        // Handle other errors
                        console.error(error);

                    }
                });
        },
        filepondInitialized()
        {
            setOptions({

                server:{
                    process: {
                        url:'/upload',
                        onerror:(response) => {
                            serverMessage = JSON.parse(response)
                        },
                        ondata: (formData) => {
                           // formData.append('model', this.model);
                            return formData;
                        },
                        headers: {
                            'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').content,
                        }
                    }
                },
                labelFileProcessingError:() =>
                {
                    return serverMessage.error;
                }
            });
        },
        handleProcessFile(error , file)
        {


            if(error)
            {
                console.error(error);
                return;
            }

            let objecto = JSON.parse(file.serverId);
            this.images.unshift(objecto)
            this.disableButton = false

        }
    }
}
</script>
