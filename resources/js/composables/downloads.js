import {ref} from 'vue';
import axios from "axios";

export default function useDownloads()
{
    const download = ref([]);

    const getDownload = async(id) => {
        let response =  await axios.get('/api/downloads/'+id)
        download.value = response.data.data;
    }


    const markDownloadAsDownloaded = async(id) => {
        let response =  await axios.post('/api/downloads-mark-as-downloaded/'+id)
        //download.value = response.data.data;
    }

    return {
        download,
        getDownload,
        markDownloadAsDownloaded
    }
}
