<template>

    <div>

        <header class="bg-white border-b shadow-md sticky top-0 z-50">

            <nav class="mx-auto flex w-full items-center justify-between " aria-label="Global">

                <a href="/" class="text-3xl font-bold px-6 text-blue-600">Enviamelos</a>

                <button @click="downloadFolder" :disabled="loadingIcon"  class="disabled:bg-gray-700 disabled:text-white inline-flex  bg-blue-600 px-4 sm:px-10 py-6 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">

                    <div class="flex space-x-2 items-center">

                        <svg v-if="loadingIcon" aria-hidden="true" class="w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>

                        Descargar
                    </div>

                </button>

            </nav>

        </header>


        <div v-if="download.message" class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">

            <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">

                <div class="ml-4 mt-4">
                    <h3 class="text-base font-semibold leading-6 text-gray-900"> {{download.message}}</h3>
                </div>

            </div>

        </div>

        <main class="container mx-auto">

            <div class="col-span-8 px-2 pt-4">

                <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">

                    <li class="relative" v-for="media in download.media">
                        <div class="group aspect-h-7 aspect-w-10  w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 flex flex-col justify-center">
                            <img :src="media.thumb" alt="" class="pointer-events-none object-cover group-hover:opacity-75">

                        </div>

                        <div class="flex w-full justify-between items-center p-2">

                            <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">{{ media.file_name }}</p>

                            <button @click='downloadSingle(media.id,media.file_name)'>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </button>

                        </div>
                    </li>



                </ul>

            </div>

        </main>

    </div>
</template>

<script setup>

    import useDownloads from "../../composables/downloads";
    import {onMounted,ref} from 'vue';
    import axios from 'axios';
    const loadingIcon = ref(false);
    const {download,getDownload,markDownloadAsDownloaded} = useDownloads()

    const props = defineProps({
        id: {required:true,type:String}
    });

    onMounted( async () =>{
        getDownload(props.id);
    });

    const downloadFolder =  () => {

        loadingIcon.value = true;
        axios.get('/api/downloads-get-folder/'+download.value.id, { responseType: 'blob' })
        .then(response => {

            const blob = new Blob([response.data], { type: 'application/zip' });
            const downloadUrl = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = downloadUrl;
            link.setAttribute('download', 'download.zip');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            markDownloadAsDownloaded(download.value.id);
            loadingIcon.value = false;

        })
        .catch(error => {
            console.error('Error downloading ZIP:', error);
        });

    }

    const downloadSingle = (id,name) =>
    {
        console.log("downloading " + id)

        axios.get('/api/downloads-get-single-file/'+id, { responseType: 'arraybuffer' })
        .then(response => {

            let blob = new Blob([response.data], { type: 'application/pdf' })
            let link = document.createElement('a')
            link.href = window.URL.createObjectURL(blob)
            link.download = name
            link.click()

        }).catch(error => {
            console.error('Error downloading SINGLE FILE :', error);
        });

    }




</script>
