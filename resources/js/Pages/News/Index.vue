<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Свежее" />
    <div class="text-xl flex justify-center items-center mt-8">
        Новости
    </div>
    <div class="flex flex-col px-2 md:px-32 mt-8">
        <div class="grid grid-cols-3 mt-8" v-for="post in posts" :key="post.id">
            <div class="col-span-1">
             <img :src="post.image" alt="" class="w-64">   
            </div>
            <div class="col-span-3">
                <div>
                    {{post.title}} 
                </div>
                <div>
                    {{ post.description }}
                </div>
                <div>
                    <Link :href="route('news.show', post.id)" class="font-semibold m-3 flex items-center">Подробнее...
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Main from "../../Layouts/MainLayout.vue"
import Pages from "../../Components/Pages.vue"
import { Axios } from 'axios';
export default {
    name: "Catalog",
    components: {
        Pages
    },
    props: [
        'posts',
    ],
    layout: Main,
    data() {

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
    }
}
</script>