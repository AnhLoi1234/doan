<template>
    <div>
        <Banner></Banner>
        <Handbook></Handbook>
        <Specialist></Specialist>
        <Service></Service>
    </div>
</template>
<script>
import Banner from './Banner.vue'
import Handbook from './Handbook.vue'
import Service from './Service.vue'
import Specialist from './Specialist.vue'
export default {
    components: {
        Banner,
        Handbook,
        Service,
        Specialist,
    }
}
</script>
<style>
</style>