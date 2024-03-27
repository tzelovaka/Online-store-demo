<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Каталог" />
    <div class="flex flex-col gap-8 px-2 md:px-32 mt-8">
        <div class="flex justify-center">
            <div>
                {{ item.name + ' для' }}
            </div>
            <div v-for="mark in marks" :key="mark.id">
                <div v-if="mark.id === versions.find(version => version.id === generations.find(gen => gen.id === item.generation_id).version_id).mark_id" class="ml-1">
                    {{ mark.name }}
                </div>
            </div>
            <div v-for="version in versions" :key="version.id">
                <div v-if="version.id === generations.find(gen => gen.id === item.generation_id).version_id" class="ml-1">
                    {{ version.name }}
                </div>
            </div>
            <div v-for="generation in generations" :key="generation.id">
                <div v-if="generation.id === item.generation_id" class="ml-1">
                    {{ '(' + generation.name + ')' }}
                </div>
            </div>
        </div>
        <div class="flex flex-col md:grid md:grid-cols-2 gap-x-4">
            <div class="flex flex-col">
                <img :src="item.image" class="rounded-xl">
                <div class="grid grid-cols-3 justify-items-center my-4 gap-y-2 md:gap-y-4">
                    <div class="text-lg lg:text-2xl flex flex-col-reverse lg:flex-row items-center justify-center">
                        Материал <font-awesome-icon :icon="['fas', 'dna']" class="text-cgreen h-8 lg:h-12 ml-2" />
                    </div>
                    <div class="text-lg lg:text-2xl flex flex-col-reverse lg:flex-row items-center justify-center">
                        Наличие <font-awesome-icon :icon="['fas', 'list-check']" class="text-cgreen h-8 lg:h-12 ml-2" />
                    </div>
                    <div class="text-lg lg:text-2xl flex flex-col-reverse lg:flex-row items-center justify-center">
                        Рейтинг <font-awesome-icon :icon="['fas', 'ranking-star']" class="text-cgreen h-8 lg:h-12 ml-2" />
                    </div>
                    <div class="flex items-center justify-center text-center">
                        Оцинкованная сталь 0.8мм
                    </div>
                    <div class="flex items-center justify-center text-center">
                        326
                    </div>
                    <div class="flex items-center justify-center text-center">
                        4.5 / 5 (76)
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-col border-2 border-cgrey rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div @click="choice = 'left'"
                            class="rounded-xl flex justify-center h-36 items-center border cursor-pointer"
                            :class="[choice === 'left' ? 'border-2 border-cgreen' : 'border-1 border-cgrey']">
                            Левая
                        </div>
                        <div @click="choice = 'right'"
                            class="rounded-xl flex justify-center h-36 items-center border cursor-pointer"
                            :class="[choice === 'right' ? 'border-2 border-cgreen' : 'border-1 border-cgrey']">
                            Правая
                        </div>
                        <div @click="choice = 'both'"
                            class="rounded-xl flex justify-center h-36 items-center border cursor-pointer"
                            :class="[choice === 'both' ? 'border-2 border-cgreen' : 'border-1 border-cgrey']">
                            Обе
                        </div>
                    </div>
                    <div class="flex md:flex-row flex-col-reverse items-center justify-center mt-4">
                        <div class="flex mx-auto justify-center mt-4 md:mt-0">
                            <button @click="count > 1 ? count-- : null"
                                class="flex bg-cgreen h-8 w-8 items-center justify-center text-white text-bold rounded-full active:bg-cdeep">-</button>
                            <div class="flex items-center w-16 h-8 justify-center mx-2 border rounded-full border-1-cgrey">
                                {{ count }}</div><button @click="count < 999 ? count++ : null"
                                class="flex active:bg-cdeep bg-cgreen h-8 w-8 items-center justify-center text-white text-bold rounded-full">+</button>
                        </div>
                        <div
                            class="bg-red-500 text-white rounded-xl flex w-48 py-4 px-2 justify-center text-md md:text-xl mx-auto font-semibold">
                            {{ (item.cost * count * (choice === 'both' ? 2 : 1)).toFixed(2) + ' BYN' }}</div>
                    </div>
                    <div @click="buying"
                        class="mt-4 mx-auto bg-cgreen text-white rounded-full py-3 px-6 hover:cursor-pointer active:bg-cdeep">
                        Положить в корзину
                    </div>
                </div>
                <div class="indent-8 text-justify mt-4 border-2 border-cgrey px-3 py-2 rounded-xl">
                    {{ item.description }}
                </div>
                <div class="border-2 border-cgrey rounded-xl mt-4 p-4">
                    <form @submit.prevent="store" class="flex flex-col w-3/4 mx-auto">
                        <div class="mx-auto text-lg">Уже получили заказ? Оставьте свой комментарий!</div>
                        <label class="text-xs mt-4" for="order">Номер вашего заказа</label>
                        <input type="text" name="order" id="order" class="rounded-2xl border-2 border-cgreen">
                        <label class="text-xs mt-2" for="order">Ваш комментарий</label>
                        <textarea rows="5" cols="" id="comment" class="rounded-2xl border-2 border-cgreen"></textarea>
                        <input type="submit" name="" value="Отправить"
                            class="text-white hover:cursor-pointer bg-cgreen active:bg-cdeep rounded-full py-2 px-4 mt-2 w-32 mx-auto">
                    </form>
                </div>
            </div>

        </div>
        <div class="flex items-center justify-center">
            Отзывы
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
        'marks',
        'versions',
        'generations',
        'item',
    ],
    layout: Main,
    data() {
        return {
            mark: null,
            version: null,
            generation: null,
            count: 1,
            choice: 'left'
        }
    },
    computed: {

    },
    beforeMount() {
    },
    watch: {

    },
    mounted() {
        console.log(this.item);
    },
    methods: {
        store() {
            console.log('TEST');
        },
        buying() {
            let existingArray = JSON.parse(localStorage.getItem('items')) || [];
            existingArray.push({
                item: this.item,
                count: this.count,
                choice: this.choice
            });
            localStorage.setItem('items', JSON.stringify(existingArray))
        }
    },
}
</script>