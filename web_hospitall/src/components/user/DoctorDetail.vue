<template >
    <div v-if="book">
        <div class="wrapper breadcrumb">
            <ul>
                <li><a href="" class="bx bxs-home"></a></li>
                <li class="line">/</li>
                <li><a href="">Cẩm nang</a></li>
                <li class="line">/</li>
                <li><a href="">Sản phẩm Y tế</a></li>
            </ul>
        </div>
        <div class="wrapper">
            <div class="order__item--left detail" style="margin-bottom: 3rem;">
                <div>
                    <img class="order__item--left--image detail" :src="book.doctor.info.avatar" alt="" srcset="">
                </div>
                <div class="order__item--left--content">
                    <h3>{{ book.doctor.info.position }} {{ book.doctor.info.name }}</h3>
                    <p>Chuyên gia trên 35 năm kinh nghiệm trong lĩnh vực bệnh lý Tiêu hóa</p>
                    <p>Chuyên gia đầu ngành trong lĩnh vực bệnh lý Tiêu hóa</p>
                    <p>Nguyên Giám đốc Bệnh viện Đại học Y Hà Nội</p>
                    <p>Bác sĩ khám cho người bệnh từ 3 tuổi trở lên</p>
                    <div class="order__item--left--content--footer">
                        <span class="bx bx-current-location"></span>
                        <span>Hà Nội</span>
                    </div>
                    <div class="post__socical">
                        <button>
                            <span class="bx bxs-like"></span>
                            <span>Like</span>
                        </button>
                        <button>
                            <span class="bx bxs-share"></span>
                            <span>Share</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="order__item--right row">
                <div class="col-lg-7">
                    <ItemCalendar :times="times" :doctor="book.doctor" :isDetail="true" :time_="book.time">
                    </ItemCalendar>
                </div>
                <div class="" style="flex: 1;flex-wrap: wrap;">
                    <ul class="col-12">
                        <li>ĐỊA CHỈ KHÁM</li>
                        <li>Bệnh viện Ung bướu Hưng Việt</li>
                        <li>34 Đại Cồ Việt, Hai Bà Trưng, Hà Nội</li>
                    </ul>
                </div>
            </div>
            <button @click="orderNow()" class="button-order">
                ĐẶT LỊCH NGAY
            </button>
        </div>
        <div class="order__container show ">
            <div class="wrapper" style="padding: 2rem;">
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

        </div>
        <div class="wrapper">
            <div class="reply">
                <p class="reply__title">
                    Phản hồi của bệnh nhân sau khi đi khám
                </p>
                <div class="reply__item">
                    <div class="reply__item--top">
                        <a href="">Đinh Công Sáng</a>
                        <span class="bx bxs-check-circle"></span>
                        <span>Đã khám ngày 06/04/2022</span>
                    </div>
                    <p class="reply__item--content">
                        Dịch vụ khám chữa bệnh rất tốt y bác sỹ nhiệt tình chu đáo và tôi rất yên tâm khi đến đây.theo
                        suy nghĩ của tôi nếu như khám và phân loại bệnh nhân được sẽ tiết kiệm thời gian hơn cho bệnh
                        nhân.xin cảm ơn các bạn
                    </p>
                </div>
                <hr>
                <div class="reply__item">
                    <div class="reply__item--top">
                        <a href="">Đinh Công Sáng</a>
                        <span class="bx bxs-check-circle"></span>
                        <span>Đã khám ngày 06/04/2022</span>
                    </div>
                    <p class="reply__item--content">
                        Dịch vụ khám chữa bệnh rất tốt y bác sỹ nhiệt tình chu đáo và tôi rất yên tâm khi đến đây.theo
                        suy nghĩ của tôi nếu như khám và phân loại bệnh nhân được sẽ tiết kiệm thời gian hơn cho bệnh
                        nhân.xin cảm ơn các bạn
                    </p>
                </div>
                <hr>
                <div class="reply__item">
                    <div class="reply__item--top">
                        <a href="">Đinh Công Sáng</a>
                        <span class="bx bxs-check-circle"></span>
                        <span>Đã khám ngày 06/04/2022</span>
                    </div>
                    <p class="reply__item--content">
                        Dịch vụ khám chữa bệnh rất tốt y bác sỹ nhiệt tình chu đáo và tôi rất yên tâm khi đến đây.theo
                        suy nghĩ của tôi nếu như khám và phân loại bệnh nhân được sẽ tiết kiệm thời gian hơn cho bệnh
                        nhân.xin cảm ơn các bạn
                    </p>
                </div>
                <hr>
                <div class="reply__item">
                    <div class="reply__item--top">
                        <a href="">Đinh Công Sáng</a>
                        <span class="bx bxs-check-circle"></span>
                        <span>Đã khám ngày 06/04/2022</span>
                    </div>
                    <p class="reply__item--content">
                        Dịch vụ khám chữa bệnh rất tốt y bác sỹ nhiệt tình chu đáo và tôi rất yên tâm khi đến đây.theo
                        suy nghĩ của tôi nếu như khám và phân loại bệnh nhân được sẽ tiết kiệm thời gian hơn cho bệnh
                        nhân.xin cảm ơn các bạn
                    </p>
                </div>
                <hr>
                <div class="reply__item">
                    <div class="reply__item--top">
                        <a href="">Đinh Công Sáng</a>
                        <span class="bx bxs-check-circle"></span>
                        <span>Đã khám ngày 06/04/2022</span>
                    </div>
                    <p class="reply__item--content">
                        Dịch vụ khám chữa bệnh rất tốt y bác sỹ nhiệt tình chu đáo và tôi rất yên tâm khi đến đây.theo
                        suy nghĩ của tôi nếu như khám và phân loại bệnh nhân được sẽ tiết kiệm thời gian hơn cho bệnh
                        nhân.xin cảm ơn các bạn
                    </p>
                </div>
                <hr>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import Request from '../../Request';
import ItemCalendar from './components/ItemComponent/ItemCalendar.vue';

export default {
    data() {
        return {
            times: []
        };
    },
    methods: {
        orderNow: function () {
            this.$router.push({ name: "DoctorForm" });
        }
    },
    computed: {
        ...mapState(["book"])
    },
    mounted() {
        (async () => {
            let result = await Request.Get("/doctors");
            this.doctors = result.data.data;
            result = await Request.Get("/timebooks");
            this.times = result.data.data;
        })();
    },
    components: { ItemCalendar }
}
</script>