<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Каталог" />
    <div class="flex flex-col gap-8 px-2 md:px-32 mt-8">
        <img :src="post.image" alt="">
        {{ post.title }}
        {{ post.description }}
    </div>
    <div v-if="adminAccess" class="ml-4 mt-4">
        <Link :href="route('news.edit', post.id)" class="border-2 border-cgreen rounded-full cursor-pointer py-2 px-4 w-36 justify-center bg-cgreen text-white flex items-center">
        Изменить
        </Link>
    <div @click="deletePost()" class="mt-4 border-2 border-red-400 rounded-full cursor-pointer py-2 px-4 w-36 justify-center bg-red-400 text-white flex items-center">
        Удалить
    </div>
    </div>
</template>
<script>
import Main from "../../Layouts/MainLayout.vue"
import Pages from "../../Components/Pages.vue"
export default {
    name: "Catalog",
    components: {
        Pages
    },
    props: [
        'post', 'adminAccess'
    ],
    layout: Main,
    data() {
        return {

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
        deletePost(){
            this.$inertia.delete(`/news/${this.post.id}`)
        }
}
}
</script>