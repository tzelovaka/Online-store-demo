<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Каталог" />
    <div class="text-xl flex justify-center items-center mt-8">
        Каталог
    </div>
    <div class="flex flex-col lg:grid lg:grid-cols-3 gap-8 px-2 md:px-32 mt-8" :class="rows()">
        <Sidebar :marks="marks" :versions="versions" :generations="generations" :latest="latest" :markId="markId" :versionId="versionId" :generationId="generationId"/>
        <div class="col-span-2 flex flex-col md:grid md:grid-cols-2 gap-8">
            <div v-for="item in items.data" :key="item.id"
                class="flex flex-col justify-center border-2 border-cgrey rounded-2xl transition ease-in-out delay-50 hover:-translate-y-1 hover:bg-cgrey duration-225 ...">
                <Link v-if="searchValidate(item.name, item.mark_id, item.version_id, item.generation_id)" :href="route('catalog.show', item.id)" class="">
                <div class="flex w-full justify-center">
                    {{ item.name }}
                </div>
                <div class="grid grid-cols-2 mx-4 gap-2 mt-4">
                    <img :src="item.image" class="rounded-2xl" alt="">
                    <div class="flex flex-col items-center justify-center">
                        <div v-for="mark in marks" :key="mark.id">
                            <div v-if="mark.id === versions.find(version => version.id === generations.find(gen => gen.id === item.generation_id).version_id).mark_id">
                                {{ mark.name }}
                            </div>
                        </div>
                        <div v-for="version in versions" :key="version.id">
                            <div v-if="version.id === generations.find(gen => gen.id === item.generation_id).version_id">
                                {{ version.name }}
                            </div>
                        </div>
                        <div v-for="generation in generations" :key="generation.id">
                            <div v-if="generation.id === item.generation_id">
                                {{ generation.name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center text-white justify-center bg-red-500 py-4 rounded-2xl m-4">
                    Цена: {{ item.cost + ' BYN' }}
                </div>
                </Link>
            </div>
        </div>

    </div>
    <Pages class="mt-8" v-bind:searchUrl="searchUrl" :links="items.links" :totalPages="totalPages" />
</template>
<script>
import Main from "../../Layouts/MainLayout.vue"
import Pages from "../../Components/Pages.vue"
import Sidebar from "../../Components/Sidebar.vue"
import { Axios } from 'axios';
export default {
    name: "Catalog",
    components: {
        Pages, Sidebar
    },
    props: [
        'marks',
        'latest',
        'versions',
        'generations',
        'items',
        'searchUrl',
        'thisItems',
        'totalPages'
    ],
    layout: Main,
    data() {
        return {
            mark: null,
            version: null,
            generation: null,
            markId: null,
            versionId: null,
            generationId: null,
            search: null,
        }
    },
    computed: {
    },
    beforeMount() {
        const params = new URLSearchParams(window.location.search);
        this.markId = params.get('mark_id');
        this.versionId = params.get('version_id');
        this.generationId = params.get('generation_id');
        this.search = params.get('search');
        console.log(this.versions.find(ver => ver.id === this.generations.find(gen => gen.id === 5).version_id));
    },
    watch: {
        
    },
    mounted() {
        console.log(this.items);
    },
    methods: {
        rows() {
            return 'lg:grid-rows-' + Math.ceil(this.thisItems / 2)
        },
        searchValidate(name, markId, versionId, generationId){
            const regex = new RegExp(name, "g");
            const matches = name.match(regex);
            return true
        }
    },
}
</script>