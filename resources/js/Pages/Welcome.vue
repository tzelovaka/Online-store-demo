<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Главная" />
    <Slide :marks="marks" :versions="versions" :generations="generations" :items="items" />
    <div>
        Не нашли нужного предложения? Напишите нам!
    </div>
</template>
<script>
import Slide from "../Components/Slide.vue"
import Footer from "../Components/Footer.vue"
import Main from "../Layouts/MainLayout.vue"
import { Axios } from 'axios';
export default {
    name: "Index",
    components: {
    Slide
    },
    props: [
        'marks',
        'versions',
        'generations',
        'items',
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