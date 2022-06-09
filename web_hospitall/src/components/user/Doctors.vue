<template>
    <div class="order__top" style="background: url('https://cdn.bookingcare.vn/fo/2019/12/13/120933-tieu-hoa.jpg');">
        <div class="order__container" :class="more ? 'show' : ''">
            <div v-if="specical" class="wrapper">
                <h3>{{ specical.namespecical }}</h3>
                <h4>Bác sĩ Chuyên khoa {{ specical.namespecical }}</h4>
                <p v-html="specical.description_specical"></p>
            </div>
            <div>
                <div class="wrapper">
                    <span @click="more = !more" class="view__more hide">{{ more ? 'Thu lại' : 'Đọc thêm' }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="order__wrapper">
        <div v-if="!loading" class="wrapper">
            <div v-if="doctors.length > 0">
                <ItemDoctor v-for="doctor in doctors" :times="times" :doctor="doctor" :key="doctor.info.id">
                </ItemDoctor>
            </div>
            <div v-else class="loading__content">
                Không có bác sĩ nào ở chuyên khoa này.
            </div>
        </div>
        <div v-else class="loading__content">
            <span class='bx bx-loader-alt loading'></span>
        </div>
    </div>
</template>
<script>
import Request from '../../Request';
import ItemDoctor from './components/ItemComponent/ItemDoctor.vue';
export default {
    components: { ItemDoctor },
    data() {
        return {
            doctors: [],
            times: [],
            loading: true,
            specical: null,
            more: false
        }
    },
    mounted() {
        (async () => {
            let result = await Request.Post("/doctor-slug", {
                slug: this.$route.params.slug
            });
            this.doctors = result.data.data;
            result = await Request.Get("/timebooks");
            this.times = result.data.data;
            result = await Request.Post("/specicallist-slug", {
                slug: this.$route.params.slug
            });
            this.specical = result.data.data;
            this.loading = false;
        })();
    }
}
</script>