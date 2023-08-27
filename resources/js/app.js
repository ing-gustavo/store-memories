import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import {createApp} from 'vue/dist/vue.esm-bundler.js';
import PhotosCreate from '../js/components/Photos/Create.vue';
import PhotosEdit from '../js/components/Photos/Edit.vue';
import PhotosConfirm from '../js/components/Photos/Confirmar.vue';
import DownloadsShow from '../js/components/Downloads/DownloadsShow.vue';

const app = createApp({});
app.component('PhotosCreate', PhotosCreate);
app.component('PhotosEdit',PhotosEdit);
app.component('PhotosConfirm',PhotosConfirm);
app.component('DownloadsShow',DownloadsShow);
app.mount("#app");
