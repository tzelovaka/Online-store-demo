<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Каталог" />
    <div class="flex flex-col gap-8 px-2 md:px-32 mt-8">
        <form @submit.prevent="update">
        <input type="text" name="title" id="news" class="rounded-full border-2 border-cgreen mb-4 w-full" v-model="title">
        <textarea rows="7" cols="30" class="rounded-xl border-2 border-cgreen mb-4 w-full" v-model="description"></textarea>
        <button class="border-2 border-cgreen rounded-full cursor-pointer py-2 px-4 w-full bg-cgreen text-white">
            Изменить новость
        </button>
    </form>
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
        'post',
    ],
    layout: Main,
    data() {
        return {
            id: this.post.id,
            title: this.post.title,
            description: this.post.description
        }
    },
    computed: {

    },
    beforeMount() {
    },
    watch: {

    },
    mounted() {
        console.log(this.post);
    },
    methods: {
        update(){
            this.$inertia.patch(`/news/${this.id}`, {title: this.title, description: this.description})
        }
}
}
</script>