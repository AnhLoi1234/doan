<template>
    <div v-if="book" class="wrapper">
        <div class="order__form">
            <div class="order__form--top">
                <img :src="urlImage + book.doctor.info.avatar" alt="">
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
                    <input @change="onChangeBookFor($event)" v-model="bookFor" value="1" type="radio"
                        name="order-for" />
                    <label for="">Đặt cho mình </label>
                </div>
                <div>
                    <input @change="onChangeBookFor($event)" v-model="bookFor" value="2" type="radio"
                        name="order-for" />
                    <label for=""> Đặt cho người thân </label>
                </div>
            </div>
            <InputComponent icon="bx bx-user" :onChange="onChangeInput" name="fullname" type="text"
                placeholder="Nhập họ và tên" :errorMessage="fullname.error ? 'Họ tên không được trống' : ''"
                :value="fullname.value">
            </InputComponent>
            <p class="order__form--desc">Hãy ghi rõ Họ Và Tên, viết hoa những chữ cái đầu tiên, ví dụ: Trần Văn Phú
            </p>
            <div class="order__form--for">
                <div>
                    <input @change="onChangeGender($event)" v-model="gender" value="Nam" type="radio"
                        name="order-gender" id="">
                    <label for="">Nam</label>
                </div>
                <div>
                    <input @change="onChangeGender($event)" v-model="gender" value="Nữ" type="radio" name="order-gender"
                        id="">
                    <label for="">Nữ</label>
                </div>
            </div>
            <InputComponent icon="bx bx-phone" :onChange="onChangeInput" name="phone" type="text"
                placeholder="Nhập số điện thoại"
                :errorMessage="!phone.error ? '' : phone.error === 1 ? 'Số điện thoại không được trống' : 'Số điện thoaị không đúng định dạng'"
                :value="phone.value"></InputComponent>
            <InputComponent icon="bx bx-envelope" :onChange="onChangeInput" name="email" type="text"
                placeholder="Nhập email"
                :errorMessage="!email.error ? '' : email.error === 1 ? 'Email không được trống' : 'Emal không đúng định dạng'"
                :value="email.value">
            </InputComponent>
            <!-- <InputComponent icon="bx bx-calendar" type="date"></InputComponent> -->
            <ItemSelectAddress :list="provinces" :onChangeAddress="onChangeAddress" name="districts"
                text="Tỉnh / Thành phố" :selected="null"></ItemSelectAddress>
            <p class="color-red" :class="province.error ? 'active' : 'hidden'">
                {{ 'Tỉnh/Thành phố không được để trống' }}</p>
            <ItemSelectAddress :list="districts" :onChangeAddress="onChangeAddress" name="wards" text="Quận / Huyện"
                :selected="null"></ItemSelectAddress>
            <p class="color-red" :class="district.error ? 'active' : 'hidden'">
                {{ 'Quận/Huyện không được để trống' }}</p>
            <ItemSelectAddress :list="wards" :onChangeAddress="onChangeAddress" text="Xã / Phường" :selected="null">
            </ItemSelectAddress>
            <p class="color-red" :class="province.error ? 'active' : 'hidden'">
                {{ 'Phường/Xã không được để trống' }}</p>

            <div class="order__form--textarea">
                <textarea v-model="description.value" @change="onChangeInput($event)" name="description"
                    placeholder="Lý do khám"></textarea>
                <span class="bx bxs-plus-circle"></span>
            </div>
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
            <button @click="onSubmit" class="order__form--button">Xác nhận đặt
                khám</button>
            <p class="order__form--desc">
                Bằng việc xác nhận đặt khám, bạn đã hoàn toàn đồng ý với
                <span>Điều khoản sử dụng</span> dịch vụ của chúng tôi.
            </p>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
import { REGEX_EMAIL, REGEX_NUMBER_PHONE, URL_IMAGE } from '../../Config';
import Request from '../../Request';
import InputComponent from '../manage/InputComponent.vue';
import ItemSelectAddress from './components/ItemComponent/ItemSelectAddress.vue';

export default {
    computed: {
        ...mapState(["book", "user"])
    },
    data() {
        return {
            urlImage: URL_IMAGE,
            provinces: [],
            districts: [],
            wards: [],
            description: {
                value: '',
                error: false
            },
            province: {
                value: '',
                error: false
            },
            district: {
                value: '',
                error: false
            },
            ward: {
                value: '',
                error: false
            },
            fullname: {
                value: '',
                error: false
            },
            phone: {
                value: '',
                error: false
            },
            email: {
                value: '',
                error: false
            },
            birthday: {
                value: '',
                error: false
            },
            bookFor: "1",
            gender: "Nam"
        }
    },
    methods: {
        onSubmit: async function () {
            this.fullname.error = this.fullname.value.length === 0;
            this.email.error = this.email.value.length === 0;
            this.phone.error = this.phone.value.length === 0;
            this.province.error = this.province.value.length === 0;
            this.district.error = this.district.value.length === 0;
            this.ward.error = this.province.value.length === 0;
            if (!this.fullname.error && !this.phone.error && !this.district.error && !this.ward.error
                && !this.email.error && !this.province.error) {
                try {

                    await Request.Post('/booklists', {
                        iddoctor: this.book.doctor.info.idadmin,
                        idtimebook: this.book.time.id,
                        idtimedoctor: this.book.date.id,
                        iduser: this.user.id,
                        fullname: this.fullname.value,
                        description: this.description.value,
                        gender: this.gender,
                        phone: this.phone.value,
                        email: this.email.value,
                        address: `${this.province.value},${this.district.value},${this.ward.value}`,
                        typeBookList: this.bookFor
                    });
                    this.$router.push({ name: 'Profile' });
                    return true;
                    // gui mail
                } catch (error) {
                    alert(error);
                }
            }
        },
        onChangeInput: function (event) {
            this[event.target.name].value = event.target.value;
            switch (event.target.name) {
                case 'phone':
                    this[event.target.name].error = event.target.value.length === 0 ? 1 :
                        !event.target.value.match(REGEX_NUMBER_PHONE) ? 2 : false
                    break;
                case 'email':
                    this[event.target.name].error = event.target.value.length === 0 ? 1 :
                        !event.target.value.match(REGEX_EMAIL) ? 2 : false
                    break;
                case 'description':
                    break;
                default:
                    this[event.target.name].error = event.target.value.length === 0
                    break;
            }
        },
        onChangeGender: function (event) {
            this.gender = event.target.value;
        },
        onChangeBookFor: function (event) {
            this.bookFor = event.target.value;
            if (this.bookFor === 1) {
                if (this.user) {
                    this.fullname.value = this.user.fullname;
                    this.phone.value = this.user.phone;
                    this.email.value = this.user.email;
                    this.gender = this.user.gender;
                }
            }
            else {
                this.fullname.value = '';
                this.phone.value = '';
                this.email.value = '';
            }
        },
        onChangeAddress: async function (event) {
            try {
                const { id, name } = JSON.parse(event.target.value);
                let idName;
                switch (event.target.name) {
                    case 'districts':
                        idName = '_province_id';
                        this.province.value = name;
                        this.province.error = false;
                        break;
                    case 'wards':
                        idName = '_district_id';
                        this.district.value = name;
                        this.district.error = false;
                        break;
                    default:
                        this.ward.value = name;
                        this.ward.error = false;
                        break;
                }
                if (idName) {
                    let object = {};
                    object[idName] = id;
                    const result = await Request.Post(`/${event.target.name}`, object);
                    this[event.target.name] = result.data.data;
                    if (event.target.name !== "wards") {
                        this.wards = [];
                    }
                }

            } catch (error) {
                alert(error);
            }
        }
    },
    mounted() {
        if (!this.book) {
            this.$router.push({
                name: "Doctors", params: {
                    slug: this.$route.params.slug
                }
            });
        }
        else {
            this.user ? (async () => {
                try {
                    if (this.user) {
                        this.fullname.value = this.user.fullname;
                        this.phone.value = this.user.phone;
                        this.email.value = this.user.email;
                        this.gender = this.user.gender;
                    }
                    const result = await Request.Get('/provinces');
                    this.provinces = result.data.data;
                } catch (error) {
                    alert(error);
                }
            })() : (() => {
                this.$router.push({
                    name: "Login"
                });
            })();
        }
    },
    components: { InputComponent, ItemSelectAddress }
}
</script>