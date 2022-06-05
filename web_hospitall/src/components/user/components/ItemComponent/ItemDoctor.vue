<template>
    <div class="order__item row">
        <div class="order__item--left">
            <div>
                <img class="order__item--left--image" :src="doctor.info.avatar" alt="" srcset="">
                <span class="order__item--left--text">
                    Xem thêm
                </span>
            </div>
            <div class="order__item--left--content">
                <h3>{{ doctor.info.position }} {{ doctor.info.name }}</h3>
                <p>Chuyên gia trên 35 năm kinh nghiệm trong lĩnh vực bệnh lý Tiêu hóa</p>
                <p>Chuyên gia đầu ngành trong lĩnh vực bệnh lý Tiêu hóa</p>
                <p>Nguyên Giám đốc Bệnh viện Đại học Y Hà Nội</p>
                <p>Bác sĩ khám cho người bệnh từ 3 tuổi trở lên</p>
                <div class="order__item--left--content--footer">
                    <span class="bx bx-current-location"></span>
                    <span>{{ doctor.info.address }}</span>
                </div>
            </div>
        </div>
        <div class="order__item--right">
            <ItemCalendar :times="times" :doctor="doctor"></ItemCalendar>
        </div>
    </div>
</template>
<script>

import ItemCalendar from './ItemCalendar.vue';

export default {
    props: ["times", "doctor"],
    components: { ItemCalendar }
}
</script>
