<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />
    <div class="flex flex-col w-96 mt-4 mx-4">
    <form v-if="adminAccess" @submit.prevent="store">
        <input type="text" name="title" id="news" class="rounded-full border-2 border-cgreen mb-4 w-full" v-model="title">
        <textarea rows="7" cols="30" class="rounded-xl border-2 border-cgreen mb-4 w-full" v-model="description"></textarea>
        <button class="border-2 border-cgreen rounded-full cursor-pointer py-2 px-4 w-full bg-cgreen text-white">
            Добавить новость
        </button>
    </form>
</div>
</template>
<script>
import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.vue"
export default {
    name: "Dashboard",
    layout: AuthenticatedLayout,
    components:{
        Link
    },
    props: [
        'adminAccess'
    ],
    data() {
        return {
            title: '',
            description: '',
        }
    },
    methods:{
        store(){
            this.$inertia.post('/dashboard', {title: this.title, description: this.description})
        }
    }
}
</script>
