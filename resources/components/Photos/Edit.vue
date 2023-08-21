<template>

    <div class="container  mx-auto pt-2 pb-64" >

        <nav aria-label="Progress" class="bg-white">

            <ol role="list" class="divide-y divide-gray-300 border border-gray-300 md:flex md:divide-y-0">


                <li class="relative md:flex md:flex-1">
                    <!-- Completed Step -->
                    <a href="#" class="group flex w-full items-center">
                        <span class="flex items-center px-6 py-4 text-sm font-medium">
                        <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-indigo-600 group-hover:bg-indigo-800">
                            <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="ml-4 text-sm font-medium text-gray-900">Cargar imagenes </span>
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
                    <!-- Current Step -->
                    <a href="#" class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">
                        <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-indigo-600">
                        <span class="text-indigo-600">02</span>
                        </span>
                        <span class="ml-4 text-sm font-medium text-indigo-600">Correo</span>
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

        <div class="grid gap-4 grid-cols-12 bg-white">

            <div class="col-span-8 px-2 pt-4">

                <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">

                    <li class="relative" v-for="file in photos" :key="file.source">
                        <div class="group aspect-h-7 aspect-w-10  w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 flex flex-col justify-center">
                            <img :src="file.thumb" alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                            <button type="button" class="absolute inset-0 focus:outline-none">
                                <span class="sr-only">View details for IMG_4985.HEIC</span>
                            </button>
                        </div>
                        <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">{{ file.file_name }}</p>
                        <p class="pointer-events-none block text-sm font-medium text-gray-500 hidden">3.9 MB</p>
                    </li>

                </ul>

            </div>

            <div class="col-span-4 border-l-2 ">

                <div class="flex flex-col space-y-2 px-6 py-3">

                    <div>
                        <label for="from" class="block text-sm font-medium leading-6 text-gray-900">Enviar correo </label>
                        <div class="mt-2">
                            <input type="email" v-model="from" name="from" id="from" autocomplete="email" :class="{ 'border-2 border-red-500': validationErrors && validationErrors.from}"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="">
                        <label for="to" class="block text-sm font-medium leading-6 text-gray-900">Tu correo</label>
                        <div class="mt-2">
                            <input type="email" v-model="to" name="to" id="t" autocomplete="email2" :class="{ 'border-2 border-red-500': validationErrors && validationErrors.to}"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Titulo</label>
                        <div class="mt-2">
                            <input type="text" v-model="title" name="title" id="title" autocomplete="title" :class="{ 'border-2 border-red-500': validationErrors && validationErrors.title}"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="">
                        <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Mensaje</label>
                        <div class="mt-2">
                            <input type="text" v-model="message" name="message" id="message" autocomplete="message" :class="{ 'border-2 border-red-500': validationErrors && validationErrors.message}"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                </div>

                <div class="flex items-center justify-end gap-x-6  px-4 py-4 sm:px-8 mt-2" v-if="photo.uuid == null">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
                    <button type="button" @click="save" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enviar</button>
                </div>

            </div>

        </div>

    </div>

</template>


<script setup>

    import {ref} from 'vue';
    import axios from 'axios';
    const from = ref('');
    const to = ref('');
    const title = ref('');
    const message = ref('');
    const validationErrors = ref([]);

    const props = defineProps({
        photo: {required:true},
        photos: {required:true},
    });

    //Metodos

    const save = () => {

        console.log('props ' + props.photo)
        let data = {
            from:from.value,
            to:to.value,
            title:title.value,
            message:message.value,
            model_id: props.photo
        };

        axios.post('/enviar/',data)
        .catch((error) => {
                if (error.response &&  error.response.status === 422)
                {
                    validationErrors.value = error.response.data.errors;
                }
            })
            .then((response) => {
                if (response && response.status == 200)
                {
                    location.href="/downloads/"+response.data.uuid;
                }
            });
    }

</script>
