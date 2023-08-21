import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import {createApp} from 'vue/dist/vue.esm-bundler.js';
import PhotosCreate from '../components/photos/Create.vue';
import PhotosEdit from '../components/photos/Edit.vue';
import PhotosConfirm from '../components/photos/Confirmar.vue';

const app = createApp({});
app.component('PhotosCreate', PhotosCreate);
app.component('PhotosEdit',PhotosEdit);
app.component('PhotosConfirm',PhotosConfirm);
app.mount("#app");
