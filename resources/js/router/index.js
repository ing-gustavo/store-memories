import { createRouter, createWebHistory } from "vue-router";
import UploaderIndex from '../components/Uploader/UploaderIndex.vue'
import DownloadsShow from '../components/Downloads/DownloadsShow.vue'
const routes = [
    {
        path: '/uploader',
        name: 'uploader.index',
        component: UploaderIndex
    },
    {
        path: '/downloads/:id',
        name: 'downloads.show',
        component: DownloadsShow,
        props:true
    },

]

export default createRouter({
    history: createWebHistory(),
    routes
})
