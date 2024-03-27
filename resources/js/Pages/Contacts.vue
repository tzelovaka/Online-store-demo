<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Контакты" />
    {{ items }}
</template>
<script>
import Main from "../Layouts/MainLayout.vue"
import { Axios } from 'axios';
export default {
    name: "Contacts",
    components: {
    },
    props: [
        'items'
    ],
    layout: Main,
    data() {
        return {
            mark: null,
            version: null, 
            generation: null,
        }
    },
    computed: {
        
    },
    beforeMount() {
 },
 watch: {

 },
    mounted() {
    },
    methods: {

     },
}
</script>