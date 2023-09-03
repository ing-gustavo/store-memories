import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import {createApp} from 'vue/dist/vue.esm-bundler.js';
import router from './router';
const app = createApp({});
app.use(router).mount("#app");
