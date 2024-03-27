<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Корзина" />
    <div class="flex items-center justify-center mt-4 text-xl">
        Корзина
    </div>
    <div v-if="items" class="flex flex-col md:grid md:grid-cols-2 mx-auto w-5/6">
        <div>
           <div class="flex" v-for="(item, index) in items" :key="index">
            <div class="flex w-full">
               <div class="flex flex-col mx-auto border mt-4 rounded-xl w-full px-4 py-2">
           <div class="flex">
        <img :src="item.item.image" class="rounded-xl w-36">
        <div class="flex flex-col items-center justify-center w-full ml-4">
            <Link :href="route('catalog.show', item.item.id)" class="hover:text-cgreen hover:underline">
<div class="flex">
{{ item.item.name }} для
    <div v-for="mark in marks.data" :key="mark.id">
        <div v-if="mark.id===item.item.mark_id" class="ml-1">
            {{ mark.name }}
        </div>
    </div>
    <div v-for="version in versions.data" :key="version.id">
        <div v-if="version.id===item.item.version_id" class="ml-1">
            {{ version.name }}
        </div>
    </div>
    <div v-for="generation in generations.data" :key="generation.id">
        <div v-if="generation.id===item.item.generation_id" class="ml-1">
            {{ generation.name }}
        </div>
    </div> 
        </div>
    </Link>
        <div class="flex mt-2 items-center">
                            <button @click="item.count > 1 ? item.count-- : null"
                                class="flex bg-cgreen h-8 w-8 items-center justify-center text-white text-bold rounded-full active:bg-cdeep">-</button>
                            <div class="flex items-center w-16 h-8 justify-center mx-2 border rounded-full border-1-cgrey">
                                {{ item.count }}</div><button @click="item.count < 999 ? item.count++ : null"
                                class="flex active:bg-cdeep bg-cgreen h-8 w-8 items-center justify-center text-white text-bold rounded-full">+</button>
                        <div class="ml-4 border border-red-500 px-4 py-2 rounded-xl text-red-500">
                            {{ (item.item.cost * item.count * (item.choice === 'both' ? 2 : 1)).toFixed(2)  + ' BYN'}} 
                        </div>
                    </div>
    {{ item.choice==="both" ? "ремкомплект (правая + левая)" : "ремвставка" }}
    {{ item.choice==="left" ? "(левая сторона)" : null }}
    {{ item.choice==="right" ? "(правая сторона)" : null }}
        </div>
       </div>
    
        </div>
        <div class="flex items-center" @click="remove(index)">
            <font-awesome-icon :icon="['fas', 'trash']" class="h-6 ml-4 text-cgreen hover:cursor-pointer"/>
        </div>
            </div>
    </div> 
        </div>
        <div>
            <form @submit.prevent="store" class="flex flex-col w-3/4 mx-auto">
                        <div class="mx-auto text-lg">Уже получили заказ? Оставьте свой комментарий!</div>
                        <label class="text-xs mt-4" for="order">Номер телефона</label>
                        <input type="text" name="order" id="order" class="rounded-2xl border-2 border-cgreen">
                        <label class="text-xs mt-4" for="order">Email</label>
                        <input type="text" name="order" id="order" class="rounded-2xl border-2 border-cgreen">
                        <label class="text-xs mt-4" for="order">ФИО</label>
                        <div class="flex-wrapper">
                          <input type="text" name="order" id="order" class="rounded-2xl border-2 border-cgreen">
                          <input type="text" name="order" id="order" class="rounded-2xl border-2 border-cgreen">
                          <input type="text" name="order" id="order" class="rounded-2xl border-2 border-cgreen">  
                        </div>
                        <label class="text-xs mt-2" for="order">Примечание</label>
                        <textarea rows="5" cols="" id="comment" class="rounded-2xl border-2 border-cgreen"></textarea>
                        <input type="submit" name="" value="Оформить заказ"
                            class="text-white hover:cursor-pointer bg-cgreen active:bg-cdeep rounded-full py-2 px-4 mt-2 mx-auto">
                    </form>
        </div>

    </div>
    
</template>
<script>
import Main from "../Layouts/MainLayout.vue"
import { Axios } from 'axios';
export default {
    name: "Cart",
    components: {
    },
    props: [
        "item",
        "versions",
        "marks",
        "generations"
    ],
    layout: Main,
    data() {
        return {
            mark: null,
            version: null, 
            generation: null,
            items: JSON.parse(localStorage.getItem('items'))
        }
    },
    computed: {
        
    },
    beforeMount() {
 },
 watch: {

 },
    mounted() {
        console.log(this.items)
    },
    methods: {
        remove (index){
            console.log(index);
            let items = JSON.parse(localStorage.getItem('items'));
            items.splice(index, 1);
            this.items.splice (index, 1);
            console.log(items);
            localStorage.setItem('items', JSON.stringify(items));
        }
     },
}
</script>