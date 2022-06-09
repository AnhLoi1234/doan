<template>
    <div>
        <Banner></Banner>
        <Handbook></Handbook>
        <Specialist></Specialist>
        <DoctorList></DoctorList>
        <Service></Service>
    </div>
</template>
<script>
import Banner from './Banner.vue'
import Handbook from './Handbook.vue'
import Service from './Service.vue'
import Specialist from './Specialist.vue'
import DoctorList from './DoctorList.vue'
export default {
    components: {
        Banner,
        Handbook,
        Service,
        Specialist,
        DoctorList
    }
}
</script>
<style>
</style>