<template>

    <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">

        <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">

            <div class="ml-4 mt-4">
                <h3 class="text-base font-semibold leading-6 text-gray-900">{{download.message}}</h3>
            </div>

            <div class="ml-4 mt-4 flex-shrink-0">

                <button type="button" @click="downloadFolder" class="p-4 inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">

                    <svg v-if="loadingIcon" class="animate-spin -ml-1  h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <svg v-else class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    Descargar
                </button>

            </div>

        </div>
        
        <div class="col-span-8 px-2 pt-4">

            <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">

                <li class="relative" v-for="media in download.media">
                    <div class="group aspect-h-7 aspect-w-10  w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 flex flex-col justify-center">
                        <img :src="media.thumb" alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                        <button type="button" class="absolute inset-0 focus:outline-none">
                            <span class="sr-only">View details for IMG_4985.HEIC</span>
                        </button>
                    </div>
                    <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">{{ media.file_name }}</p>

                </li>

            </ul>

        </div>

    </div>

</template>
<script setup>

    import {onMounted,ref} from 'vue';
    import useDownloads from "../../composables/downloads";
    import axios from 'axios';
    const validationErrors = ref([]);
    const loadingIcon = ref(false);
    const { download, getDownload  } = useDownloads()

    const props = defineProps({
        uuid: {required:true}
    });

    onMounted(getDownload(props.uuid))

    const downloadFolder = async () => {

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
            loadingIcon.value = false;

        })
        .catch(error => {
          console.error('Error downloading ZIP:', error);
        });

    }




</script>
