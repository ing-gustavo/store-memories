<template>
    <div class="container  mx-auto pt-2 pb-64" >

        Confirm

    </div>
</template>


<script setup>

    import {ref} from 'vue';
    import axios from 'axios';

    const props = defineProps({
        photo: {required:true},
        photos: {required:true},
    });

</script>
