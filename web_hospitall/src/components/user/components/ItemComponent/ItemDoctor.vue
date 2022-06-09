<template>
    <div class="order__item row">
        <div class="order__item--left">
            <div>
                <img @click="handleDoctor" class="order__item--left--image" :src="urlImage + doctor.info.avatar" alt=""
                    srcset="">
                <!-- <span class="order__item--left--text">
                    Xem thêm
                </span> -->
            </div>
            <div class="order__item--left--content">
                <h3 @click="handleDoctor">{{ doctor.info.position }} {{ doctor.info.name }}</h3>
                <div v-html="doctor.info.description_admin"></div>
                <div class="order__item--left--content--footer">
                    <span class="bx bx-current-location"></span>
                    <span>{{ doctor.info.address }}</span>
                </div>
            </div>
        </div>
        <div class="order__item--right">
            <ItemCalendar :times="times" :doctor="doctor" :disabled="doctor?.dates?.length === 0"></ItemCalendar>
        </div>
    </div>
</template>
<script>

import { URL_IMAGE } from '../../../../Config';
import ItemCalendar from './ItemCalendar.vue';

export default {
    props: ["times", "doctor"],
    methods: {
        handleDoctor: function () {
            this.$router.push({
                name: "DoctorDetail", params: {
                    slug: this.$route.params.slug,
                    id: this.doctor?.info?.idadmin
                }
            })
        }
    },
    components: { ItemCalendar },
    data() {
        return {
            urlImage: URL_IMAGE
        }
    }
}
</script>
