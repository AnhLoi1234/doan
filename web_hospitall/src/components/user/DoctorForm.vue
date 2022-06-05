<template>
    <form class="wrapper ">
        <div class="order__form">
            <div class="order__form--top">
                <img :src="book.doctor.info.avatar" alt="">
                <div class="order__form--top--content">
                    <p>ĐẶT LỊCH KHÁM</p>
                    <p>{{ book.doctor.info.position }} {{ book.doctor.info.name }}</p>
                    <p>{{ book.time.time }} - {{ book.date.dayofweek === 0 ? "Chủ nhật" : `Thứ
                                            ${book.date.dayofweek + 1}`
                    }} - {{ book.date.day }}/{{ book.date.month }}/2022</p>
                </div>
            </div>
            <div class="order__form--for">
                <div>
                    <input type="radio" name="order-for" id="">
                    <label for="">Đặt cho mình </label>
                </div>
                <div>
                    <input type="radio" name="order-for" id="">
                    <label for=""> Đặt cho người thân </label>
                </div>
            </div>
            <div class="order__form--input">
                <span class="bx bxs-user"></span>
                <input type="text" placeholder="Họ tên bệnh nhân (bắt buộc)">
            </div>
            <p class="order__form--desc">Hãy ghi rõ Họ Và Tên, viết hoa những chữ cái đầu tiên, ví dụ: Trần Văn Phú
            </p>
            <div class="order__form--for">
                <div>
                    <input type="radio" name="order-gender" id="">
                    <label for="">Nam</label>
                </div>
                <div>
                    <input type="radio" name="order-gender" id="">
                    <label for="">Nữ</label>
                </div>
            </div>
            <div class="order__form--input">
                <span class="bx bxs-phone"></span>
                <input type="text" placeholder="Số điện thoại (bắt buộc)">
            </div>
            <div class="order__form--input">
                <span class="bx bxs-calendar"></span>
                <input type="date" placeholder="">
            </div>
            <div class="order__form--select">
                <span class="bx bx-current-location"></span>
                <select name="" id="">
                    <option value=""></option>
                </select>
                <span class="bx bx-chevron-down"></span>
            </div>
            <div class="order__form--select">
                <span class="bx bx-current-location"></span>
                <select name="" id="">
                    <option value=""></option>
                </select>
                <span class="bx bx-chevron-down"></span>
            </div>
            <div class="order__form--select">
                <span class="bx bx-current-location"></span>
                <select name="" id="">
                    <option value=""></option>
                </select>
                <span class="bx bx-chevron-down"></span>
            </div>
            <div class="order__form--textarea">
                <textarea placeholder="Lý do khám"></textarea>
                <span class="bx bxs-plus-circle"></span>
            </div>
            <!-- <div class="order__form--for">
                <input type="radio" name="" id="">
                <label for="">Thanh toán sau tại cơ sở y tế</label>
            </div> -->
            <p class="order__form--desc">Quý khách vui lòng điền đầy đủ thông tin để tiết kiệm thời gian làm thủ tục
                khám</p>
            <div class="order__form--warning">
                <p>LƯU Ý</p>
                <ul>
                    <li>Thông tin bạn cung cấp sẽ được sử dụng làm hồ sơ khám bệnh. Vì vậy khi điền thông tin,
                        bạn
                        vui
                        lòng lưu ý:</li>
                    <ul>
                        <li>Ghi rõ họ và tên, viết hoa những chữ cái đầu tiên, ví dụ: Trần Văn Phú </li>
                        <li>Điền đầy đủ, đúng và kiểm tra lại thông tin trước khi ấn "Xác nhận đặt khám"</li>
                    </ul>
                    <li>Tuân thủ quy định phòng chống dịch (đeo khẩu trang, khử khuẩn, khai báo dịch tễ) khi đến
                        khám.
                    </li>
                </ul>
            </div>
            <button class="order__form--button">Xác nhận đặt khám</button>
            <p class="order__form--desc">Bằng việc xác nhận đặt khám, bạn đã hoàn toàn đồng ý với <span>Điều khoản
                    sử dụng</span> dịch vụ của
                chúng tôi.</p>
        </div>
    </form>
</template>

<script>
import { mapState } from 'vuex';

export default {
    computed: {
        ...mapState(['book', 'user'])
    },
}
</script>