<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <div class="md:col-span-full lg:col-span-1 lg:row-span-full">
        <div class="flex flex-col justify-center items-center border-2 border-cgrey rounded-2xl p-4">
            <input v-model="textSearch" type="text" name="search" placeholder="Найти..."
                class="border-cdeep focus:border-cdeep focus:border-2 rounded-full border-2">
            <select v-model="mark" id="mark"
                class="border-cdeep mt-6 focus:border-cdeep focus:border-2 rounded-full border-2 w-40 lg:w-48 text-center">
                <option :value="null" disabled>Марка</option>
                <option v-for="mark in marks" :key="mark.id" :value="mark.id">{{ mark.name }}</option>
            </select>
            <select v-model="version" :disabled="mark === null" id="version"
                class="border-cdeep focus:border-cdeep focus:border-2 mt-4 rounded-full border-2 w-40 lg:w-48 text-center">
                <option disabled :value="null">Модель</option>
                <option v-for="version in filteredVersions()" :key="version.id" :value="version.id">{{ version.name }}
                </option>
            </select>
            <select v-model="generation" :disabled="version === null" id="generation"
                class="rounded-full border-2 mt-4 border-cdeep focus:border-cdeep focus:border-2 w-40 lg:w-48 text-center">
                <option disabled :value="null">Поколение</option>
                <option v-for="generation in filteredGenerations()" :key="generation.id" :value="generation.id">
                    {{ generation.name }}</option>
            </select>
            <div @click="search()"
                class="flex justify-center mt-6 items-center text-xl rounded-full border px-8 py-2 w-48 hover:cursor-pointer">
                <font-awesome-icon :icon="['fas', 'magnifying-glass']" class="mr-4 text-cdeep" /> Поиск
            </div>
        </div>
        <div class="flex flex-col justify-center items-center mt-12 border-2 border-cgrey rounded-2xl p-4">
            <div>
                Новости
            </div>
            <div v-for="post in latest" :key="post.id" class="mt-8 grid grid-cols-2 gap-x-2 place-items-center">
                <div>
                    <img :src="post.image" alt="" class="w-32 rounded-3xl">
                </div>
                <div class="flex items-center">
                    {{ post.title }}
                    <Link :href="route('news.show', post.id)"><font-awesome-icon
                        :icon="['fas', 'arrow-up-right-from-square']" class="ml-2 text-cdeep" />
                    </Link>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Sidebar",
    components: {
        Link
    },
    props: [
        'marks',
        'versions',
        'generations',
        'latest',
        'markId',
        'versionId',
        'generationId'
    ],
    data() {
        return {
            mark: this.markId || null,
            version: this.versionId || null,
            generation: this.generationId || null,
            textSearch: null
        }
    },
    computed: {

    },
    beforeMount() {
    },
    watch: {
        textSearch(newValue, oldValue) {
            console.log(newValue);
        },
        mark(newValue, oldValue) {
            let f = false;
            this.filteredVersions().forEach(filteredVersion => {
                if (this.version === filteredVersion) f = true
            })
            if (f === false) this.version = null
        },
        version(newValue, oldValue) {
            let f = false;
            this.filteredGenerations().forEach(filteredGeneration => {
                if (this.generation === filteredGeneration) f = true
            })
            if (f === false) this.generation = null
        }
    },
    mounted() {
    },
    methods: {
        filteredVersions() {
            let arr = []
            this.versions.forEach(version => {
                if (version.mark_id == this.mark) arr.push(version)
            })
            return arr
        },
        filteredGenerations() {
            let arr = []
            this.generations.forEach(generation => {
                if (generation.version_id == this.version) arr.push(generation)
            })
            return arr
        },
        search() {
            /*if (this.mark === null) {
                this.$inertia.get('/catalog')
            } else {
                if (this.version === null) {
                    this.$inertia.get('/catalog', { mark_id: parseInt(this.mark) })
                } else {
                    if (this.generation === null) {
                        this.$inertia.get('/catalog', { mark_id: parseInt(this.mark), version_id: parseInt(this.version) })
                    } else {
                        this.$inertia.get('/catalog', { mark_id: parseInt(this.mark), version_id: parseInt(this.version), generation_id: parseInt(this.generation) })
                    }
                }
            }*/
            const params = {
                ...(this.mark && { mark_id: parseInt(this.mark) }),
                ...(this.version && { version_id: parseInt(this.version) }),
                ...(this.generation && { generation_id: parseInt(this.generation) }),
                ...(this.textSearch && { search: this.textSearch })
            };

            this.$inertia.get('/catalog', params);
        },
    },
}
</script>
