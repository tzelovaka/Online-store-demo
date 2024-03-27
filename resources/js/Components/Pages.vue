<script setup>
import { Link } from '@inertiajs/vue3';

</script>
<template>
    <div class="flex flex-col items-center justify-center mb-8">
        <div class="flex justify-center items-center">
            <div v-for="(link, index) in memoryLinks" :key="index" class="mx-1 md:mx-4">
                <Link v-if="link.label != '...'" :href="`${link.url}${searchUrl}`">
                <div v-if="link.label === '>' || link.label === '<'">
                    <font-awesome-icon v-if="index === 0" :icon="['fas', 'circle-chevron-left']"
                        class="text-cgreen text-lg md:text-3xl" />
                    <font-awesome-icon v-else :icon="['fas', 'circle-chevron-right']"
                        class="text-cgreen text-lg md:text-3xl" />
                </div>
                <div v-else class="flex justify-center h-6 w-6 items-center md:w-12 md:h-12 rounded-full text-sm md:text-xl"
                    :class="link.active ? 'bg-cgreen text-white font-bold' : 'border-2 border-cgrey text-cgreen font-bold'">
                    {{ link.label }}
                </div>
                </Link>
                <div v-else @click="subPagination = !subPagination"
                    class="animate-pulse animate-infinite flex justify-center h-6 w-6 items-center md:w-12 md:h-12 rounded-full text-sm md:text-xl border-4 border-cgreen cursor-pointer">
                    <font-awesome-icon :icon="['fas', 'ellipsis']" class="text-cgreen"/>
                </div>
            </div>
        </div>
        <div v-show="subPagination"
            class="my-4 absolute flex items-center justify-center bg-white px-4 py-1 text-sm md:text-lg md:px-12 md:py-2 border-2 border-cgrey rounded-full">
            <div class="mr-4 text-xl text-cgreen cursor-pointer" @click="subPagination = !subPagination">
                <font-awesome-icon :icon="['fas', 'xmark']" />
            </div>
            Страница:
            <input ref="nameInput" v-model="page" type="text" name="" id="" @input="validateInput"
                class="w-16 border-b-4 border-cgreen border-t-0 py-1 focus:border-cgreen ml-4 border-r-0 border-l-0 focus:outline-none focus:ring-0 text-center">
            <Link :href="subPaginationLink" class="ml-4 text-xl text-cgreen cursor-pointer">
                <font-awesome-icon :icon="['fas', 'magnifying-glass-arrow-right']" />
            </Link>
        </div>
    </div>
</template>
<script>
export default {
    name: "Pages",
    props: {
        links: Array,
        searchUrl: String,
        totalPages: Number
    },
    data() {
        return {
            page: '1',
            subPagination: false,
        };
    },
    components: {
        Link
    },
    computed: {
        subPaginationLink(){
            let url = new URL(window.location.href);
            url.searchParams.set('page', this.page);
            let newSearchUrl = url.toString();
            console.log(newSearchUrl);
            return newSearchUrl
        },
        memoryLinks() {
            if (this.links.length > 5) {
                let links = []
                let points = {
                    url: null,
                    active: false,
                    label: '...'
                }
                for (let i = 0; i < this.links.length - 1; i++) {
                    if (this.links[i].active === true)
                        switch (Number(this.links[i].label)) {
                            case 1:
                                links.push(this.links[i])
                                links.push(this.links[i + 1])
                                links.push(this.links[i + 2])
                                if (Number(links[links.length - 1].label) + 3 < Number(this.links[this.links.length - 2].label))
                                    links.push(points);
                                links.push(this.links[this.links.length - 2])
                                links.push(this.links[this.links.length - 1])
                                links[links.length - 1].label = '>'
                                break;
                            case Number(this.links[this.links.length - 2].label):
                                links.push(this.links[0])
                                links[links.length - 1].label = '<'
                                links.push(this.links[1])
                                if (Number(links[links.length - 1].label) + 3 < Number(this.links[this.links.length - 2].label))
                                    links.push(points);
                                links.push(this.links[i - 2])
                                links.push(this.links[i - 1])
                                links.push(this.links[i])
                                break;
                            default:
                                links.push(this.links[0])
                                links[0].label = '<'
                                links.push(this.links[1])
                                if (i - 1 > 1) {
                                    if (i - 2 > 1) links.push(points);
                                    links.push(this.links[i - 1])
                                }
                                links.push(this.links[i])
                                if (i + 1 < this.links.length - 2) {
                                    links.push(this.links[i + 1])
                                    if (Number(this.links[i].label) + 2 < Number(this.links[this.links.length - 2].label)) links.push(points);
                                }
                                links.push(this.links[this.links.length - 2])
                                links.push(this.links[this.links.length - 1])
                                links[links.length - 1].label = '>'
                        }
                }
                return links;
            }
        }
    },
    mounted() {
        console.log(this.links);

    },
    methods: {
        validateInput() {
        let value = parseInt(this.page.replace(/\D/g, ''), 10);
      if (isNaN(value) || value < 1 || value > this.totalPages) {
        this.page = '';
      } else {
        this.page = value.toString();
      }
        },
        changeSubPagination(url) {
            if (url === null) this.subPagination = !this.subPagination

        }
    },
    watch: {
        subPagination: {
            handler(val, oldVal) {
                this.$nextTick(() => {
                    this.$refs.nameInput.focus();
                });
            }
        },
    }
}
</script>