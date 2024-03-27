<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="w-full">
        <div v-if="screenWidth < 768" @click="menuIsOpen = !menuIsOpen"
            class="bg-cgreen border-b-2 py-4 w-full grid grid-cols-3 place-items-center hover:cursor-pointer font-semibold text-white text-xl">
            <div></div><div>Меню </div><div v-if="!menuIsOpen"><font-awesome-icon :icon="['fas', 'bars']" class="justify-self-end border p-3 rounded-full w-4 h-4"/></div><div v-if="menuIsOpen"><font-awesome-icon :icon="['fas', 'chevron-down']" class="justify-self-end border p-3 rounded-full w-4 h-4"/></div>
        </div>
        <div v-if="menuIsOpen || screenWidth >= 768" class="bg-cgreen pb-4 md:py-4 w-full justify-center">
            <div class="flex flex-col md:flex-row md:justify-center w-full text-lg items-center text-white">
                <div>
                    <Link :href="route('index')" class="font-semibold text-white m-3 flex items-center">Главная
                    </Link>
                </div>
                <div>
                    <Link :href="route('catalog.index')" class="font-semibold text-white m-3 flex items-center">Каталог
                    </Link>
                </div>
                <div>
                    <Link :href="route('news')" class="font-semibold text-white m-3 flex items-center">Новости
                    </Link>
                </div>
                <div>
                    <Link :href="route('about')" class="font-semibold text-white m-3 flex items-center">О компании
                    </Link>
                </div>
                <div>
                    <Link :href="route('cart')" class="font-semibold text-white m-3 flex items-center">Корзина
                    <font-awesome-icon :icon="['fas', 'cart-shopping']" color="white" class="ml-2" />
                    </Link>
                </div>
                <div>
                    <Link :href="route('dashboard')" class="font-semibold text-white m-3 flex items-center">Партнёрство
                    <font-awesome-icon :icon="['fas', 'user']" color="white" class="ml-2" />
                    </Link>
                </div>
            </div>
        </div>
        <slot />
        <div class="w-full bg-cblack mt-2 flex items-center justify-center text-white py-12">
            <div class="flex flex-col">
                <div class="text-center mb-2">
                    Metaliet 2024
                </div>
                <div class="flex">
                    <font-awesome-icon class="mx-4 text-2xl" :icon="['fab', 'telegram']" />
                    <font-awesome-icon class="mx-4 text-2xl" :icon="['fab', 'viber']" />
                    <font-awesome-icon class="mx-4 text-2xl" :icon="['fab', 'instagram']" />
                    <font-awesome-icon class="mx-4 text-2xl" :icon="['fab', 'vk']" />
                </div>
                <div class="text-sm text-center mt-1">
                    Следите за нами!
                </div>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    name: "Mainlayout",
    props: [
    ],
    components: {
    },
    data() {
        return {
            screenWidth: null,
            menuIsOpen: false
        }
    },
    computed: {

    },
    beforeMount() {
    },
    watch: {

    },
    mounted() {
        this.screenWidth = window.innerWidth
        window.addEventListener('resize', () => {
            this.screenWidth = window.innerWidth
        })
    },
    methods: {

    },
}
</script>