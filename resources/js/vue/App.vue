<template>
    <router-view />
</template>

<script>
    import { ref } from 'vue';
    import List from './components/List.vue'
    import HomeRoute from './components/HomeRoute.vue'


    export default{
        name:'App',
    }
</script>