<template>
    <div class="order__top" style="background: url('https://cdn.bookingcare.vn/fo/2019/12/13/120933-tieu-hoa.jpg');">
        <div class="order__container">
            <div class="wrapper">
                <h3>Tiêu hóa</h3>
                <h4>Bác sĩ Chuyên khoa Tiêu hóa</h4>
                <p>Danh sách các bác sĩ Tiêu hóa uy tín đầu ngành tại Việt Nam:</p>
                <ul>
                    <li>Các chuyên gia có quá trình đào tạo bài bản, kinh nghiệm công tác tại các bệnh viện lớn về
                        chuyên
                        ngành Tiêu hóa tại Hà Nội</li>
                    <li>Các giáo sư, phó giáo sư là giảng viên Đại học Y khoa Hà Nội</li>
                    <li>Các bác sĩ đã, đang công tác tại các bệnh viện hàng đầu như Bệnh viện Bạch Mai, Bệnh Viện Việt
                        Đức,
                        Bệnh Viện Nhi Trung ương, Bệnh viện Y học Cổ truyền Việt Nam...</li>
                    <li>Được nhà nước công nhận các danh hiệu Thầy thuốc nhân dân, thầy thuốc ưu tú, bác sĩ cao cấp,...
                    </li>
                </ul>
                <h4>Tư vấn, khám và điều trị các Bệnh Tiêu hóa</h4>
                <ul>
                    <li>Ăn uống kém, không ngon</li>
                    <li>Rối loạn tiêu hóa, táo bón, trĩ</li>
                    <li>Nhiễm vi khuẩn HP (Helicobacter pylori)</li>
                    <li>Nội soi dạ dày, đại tràng, tiêu hóa</li>
                    <li>Buồn nôn, chướng bụng, đầy bụng ợ chua, đầy hơi</li>
                    <li>Co thắt thực quản, Hội chứng ruột kích thích</li>
                    <li>Đau bụng, dạ dày, đại tràng, thượng vị</li>
                    <li>Viêm đại tràng, dạ dày, tá tràng</li>
                    <li>Ung thư dạ dày, U nang tuyến tụy</li>
                    <li>Bệnh lý về gan, mật</li>
                    <li>...</li>
                </ul>
            </div>
            <div>
                <div class="wrapper">
                    <span class="view__more hide">Đọc thêm</span>
                </div>
            </div>
        </div>
    </div>
    <div class="order__wrapper">
        <div class="wrapper">
            <select class="order__select" name="" id="">
                <option value="">Toàn quốc</option>
            </select>
            <ItemDoctor v-for="doctor in doctors" :times="times" :doctor="doctor" :key="doctor.info.id"></ItemDoctor>
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
            times: []
        }
    },
    mounted() {
        (async () => {
            let result = await Request.Get("/doctors");
            this.doctors = result.data.data;
            result = await Request.Get("/timebooks");
            this.times = result.data.data;
        })();
    }
}
</script>