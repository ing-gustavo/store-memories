import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import {createApp} from 'vue/dist/vue.esm-bundler.js';
import PhotosCreate from '../components/Photos/Create.vue';
import PhotosEdit from '../components/Photos/Edit.vue';
import PhotosConfirm from '../components/Photos/Confirmar.vue';

const app = createApp({});
app.component('PhotosCreate', PhotosCreate);
app.component('PhotosEdit',PhotosEdit);
app.component('PhotosConfirm',PhotosConfirm);
app.mount("#app");
