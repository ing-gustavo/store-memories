<template>

    <header class="bg-white border-b shadow-md sticky top-0 z-50">
        <nav class="mx-auto flex w-full items-center justify-between " aria-label="Global">
            <a href="/" class="text-3xl font-bold px-6 text-blue-600">Enviamelos</a>

            <button @click="save" :disabled="disableSubmitButton" class="disabled:bg-gray-700 disabled:text-white inline-flex  bg-blue-600 px-4 sm:px-10 py-6 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">


                <div class="flex space-x-2 items-center">
                    <svg v-if="enviando" aria-hidden="true" class="w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>

                    Enviar
                </div>

            </button>

        </nav>
    </header>

    <main class="bg-gray-100 min-h-screen">

        <div class="flex  w-full items-start justify-center space-x-4  p-8">

            <div class=" flex w-full flex-col   sm:w-1/2 shadow-md bg-white items-center justify-center  ">

                <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center ">Cargar imagenes </h1>

                <file-pond
                    name="image"
                    ref="pond"
                    label-idle='<div class="flex space-x-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Arrastre y suelte archivos o haga clic para seleccionarlos</div>'
                    @init="filepondInitialized"
                    accepted-file-type="image/jpg, image/jpeg, image/png"
                    @processfile="handleProcessFile"
                    @addfilestart="handleFileStart"
                    credits="false"
                    :allowMultiple="true"
                    max-file-size="50MB"
                    class="items-center justify-center w-full p-4 cursor-pointer "
                />

            </div>

            <div class="flex w-full  sm:w-1/2 flex-col space-y-2 px-6 py-3 shadow-md bg-white">

                <div>
                    <label for="from" class="block text-sm font-medium leading-6 text-gray-900">Enviar correo a</label>
                    <div class="mt-2">
                        <input type="email" v-model="to" name="to" id="to"  :class="{ 'border-2 border-red-500': validationErrors && validationErrors.to}"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="">
                    <label for="to" class="block text-sm font-medium leading-6 text-gray-900">Tu correo</label>
                    <div class="mt-2">
                        <input type="email" v-model="from" name="from" id="from" autocomplete="email" :class="{ 'border-2 border-red-500': validationErrors && validationErrors.from}"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="">
                    <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Mensaje</label>
                    <div class="mt-2">
                        <input type="text" v-model="message" name="message" id="message" autocomplete="message" :class="{ 'border-2 border-red-500': validationErrors && validationErrors.message}"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

            </div>

        </div>

    </main>

    <TransitionRoot as="template" :show="open">

        <Dialog as="div" class="relative z-10" @close="open = false">

            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                            <div>
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                                <CheckIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">Misión cumplida! Tus imágenes han sido enviadas. 🙌</DialogTitle>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Estamos comprometidos en brindarte el mejor servicio posible. Tus imágenes están en buenas manos.</p>
                                </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-6">
                                <a href="/uploader" type="button" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600" @click="open = false">Entiendo</a>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>

            </div>

        </Dialog>
    </TransitionRoot>

</template>


<script setup>

    import {ref,computed} from 'vue';
    import vueFilePond, {setOptions} from 'vue-filepond';
    import "filepond/dist/filepond.min.css";
    import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
    import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
    import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
    import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
    import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
    import { CheckIcon } from '@heroicons/vue/24/outline'
    import axios from 'axios';
    const serverMessage = ref({});
    const error = ref(null);
    const FilePond = vueFilePond(FilePondPluginFileValidateType,FilePondPluginFileValidateSize,FilePondPluginImagePreview);
    const pond = ref(null);
    const disableButton = ref(false);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const validationErrors = ref([]);
    const to = ref("");
    const from = ref("");
    const message = ref("");
    const uploadedFiles = ref(0);
    const enviando = ref(false);
    const open = ref(false)

    const disableSubmitButton = computed(() => {

        if(to.value !== "" && from.value !== "" && uploadedFiles.value > 0 && !disableButton.value)
        {
            return false
        }
        else
        {
            return true;
        }
    })

    const filepondInitialized =  () => {

        setOptions({

            server:{
                process: {
                    url:'/api/uploads',
                    method:'POST',
                    withCredentials: false,
                    onerror:(response) => {
                        serverMessage.value = JSON.parse(response.data)
                    },
                    ondata: (formData) => {
                        return formData;
                    },
                    headers: {
                        'X-CSRF-TOKEN':csrfToken,

                    }
                },

                revert: (uniqueFileId, load, error) => {
                    // Should remove the earlier created temp file here
                    // ...

                    let objecto = JSON.parse(uniqueFileId);

                    console.log(JSON.stringify(JSON.parse(uniqueFileId),null,4))
                    axios.delete('/api/uploads/'+objecto.id) .then(response => {
                        uploadedFiles.value--;
                    })

                    // Can call the error method if something is wrong, should exit after
                    error('oh my goodness');

                    // Should call the load method when done, no parameters required
                    load();
                },


            },
            labelFileProcessingError:() =>
            {
                return serverMessage.value.error;
            }
        });
    }

    const handleFileStart = () =>
    {
        isLoadingCheck();
    }

    const  handleProcessFile = (error , file) =>
    {
        isLoadingCheck();
        if(error)
        {
            console.error(error);
            return;
        }

        uploadedFiles.value++;

    }

    const isLoadingCheck = () =>
    {
        let isLoading = pond.value.getFiles().filter(x=>x.status !== 5).length !== 0;
        disableButton.value = isLoading;
    }

    const  save = async () =>
    {
        validationErrors.value = [];
        enviando.value = true;

        let objecto = pond.value.getFiles();
        let archivos = [];

        for (var i = 0; i < objecto.length; i++)
        {
            archivos.push(objecto[i].serverId)
        }

        axios.post('/photos', {images:archivos,to:to.value,from:from.value,message:message.value})
        .then(response => {
            enviando.value = false;
            open.value = true;
            //location.href = '/photos/'+response.data.id+'/edit';
        })
        .catch(error => {
            if (error.response && error.response.status === 422) {
                enviando.value = false;
                validationErrors.value = error.response.data.errors;
            }
        });

    }

</script>

<style>



    .filepond--panel-root {
        background-color: transparent;
        border: 2px solid #0053ec;
    }

    @media (min-width: 30em) {
        .filepond--item {
            width: calc(50% - 0.5em);
        }
    }

    @media (min-width: 50em) {
        .filepond--item {
            width: calc(33.33% - 0.5em);
        }
    }
</style>
