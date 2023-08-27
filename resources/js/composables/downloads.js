import {ref} from 'vue';
import axios from "axios";

export default function useDownloads()
{
    const download = ref([]);

    const getDownload = async(id) => {
        let response =  await axios.get('/api/downloads/'+id)
        download.value = response.data.data;
    }

    return {
        download,
        getDownload
    }
}
