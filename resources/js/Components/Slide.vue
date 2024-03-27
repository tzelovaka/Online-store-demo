<script setup>
</script>

<template>
        <div class="py-32 md:py-64 w-full bg-gradient-to-b from-cdeep via-cgreen to-cgrey flex items-center justify-center">
        <div class="flex flex-col w-2/3 items-center justify-center">
            <div class="text-center text-5xl sm:text-7xl font-semibold text-white flex justify-center">
                Metal
            </div>
           <div class="flex flex-col justify-center items-center md:grid-cols-3 md:gap-x-8 lg:gap-x-12 md:grid-rows-1 md:grid md:justify-items-center mt-8">
<select v-model="mark" id="mark" class="rounded-full border-none w-40 lg:w-48 text-center">
<option :value="null" disabled selected>Марка</option>
  <option v-for="mark in marks.data" :key="mark.id" :value="mark.id">{{mark.name}}</option>
</select>
<select v-model="version" :disabled="mark === null" id="version" class="mt-4 md:mt-0 rounded-full border-none w-40 lg:w-48 text-center">
  <option disabled selected :value="null">Модель</option>
  <option v-for="version in filteredVersions()" :key="version.id" :value="version.id">{{version.name}}</option>
</select> 
<select v-model="generation" :disabled="version===null" id="generation" class="mt-4 md:mt-0 rounded-full border-none w-40 lg:w-48 text-center">
  <option disabled selected :value="null">Поколение</option>
  <option v-for="generation in filteredGenerations()" :key="generation.id" :value="generation.id">{{generation.name}}</option>
</select> 
           </div>
           <div @click="search()" class="flex justify-center mt-8 items-center text-xl text-white rounded-full border px-8 py-2 w-48 hover:cursor-pointer">
            <font-awesome-icon :icon="['fas', 'magnifying-glass']" class="mr-4" /> Поиск
           </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Slide",
    props: [
        'marks',
        'versions',
        'generations',
        'items',
    ],
    data() {
        return {
            mark: null,
            version: null, 
            generation: null
        }
    },
    computed: {
        
    },
    beforeMount() {
 },
 watch: {
    mark(newValue, oldValue) {
        let f=false;
        this.filteredVersions().forEach(filteredVersion =>{
            if (this.version === filteredVersion) f=true
        })
        if (f===false) this.version=null
    },
    version(newValue, oldValue) {
        let f=false;
        this.filteredGenerations().forEach(filteredGeneration =>{
            if (this.generation === filteredGeneration) f=true
        })
        if (f===false) this.generation=null
    }
 },
    mounted() {
    },
    methods: {
        filteredVersions(){
            let arr= []
            this.versions.data.forEach(version => {
                if (version.mark_id===this.mark) arr.push(version)
            })
            return arr
        },
        filteredGenerations(){
            let arr= []
            this.generations.data.forEach(generation => {
                if (generation.version_id===this.version) arr.push(generation)
            })
            return arr
        },
        search() {
        if (this.mark === null){
          this.$inertia.get('/catalog')
        }else{
          if (this.version === null) {
          this.$inertia.get('/catalog', {mark_id: parseInt(this.mark)})
          }else{
            if (this.generation === null){
            this.$inertia.get('/catalog', {mark_id: parseInt(this.mark), version_id: parseInt(this.version)})
            }else{
            this.$inertia.get('/catalog', {mark_id: parseInt(this.mark), version_id: parseInt(this.version), generation_id: parseInt(this.generation)})
            }
      }
    }
    },
     },
}
</script>
