<script setup>
</script>

<template>

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
     },
}
</script>
