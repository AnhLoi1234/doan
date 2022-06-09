<template>
    <div>
            <div v-if="user && !loading" class="wrapper profile">
        <p class="profile__title">Thông tin cá nhân</p>
        <div class="profile__top">
            <div class="profile__top--left">
                <InputComponent type="text" placeholder="Nhập ho tên" icon="bx bx-user" :value="fullname.value"
                    name="fullname" :onChange="onChange"
                    :errorMessage="fullname.error ? 'Họ tên không được trống' : ''">
                </InputComponent>
                <InputComponent type="password" placeholder="Nhập mật khẩu" name="password" :onChange="onChange"
                    icon="bx bx-lock-alt">
                </InputComponent>
                <p style="font-size: 1.2rem;font-weight: 500;opacity:0.5; margin: 0.5rem 0rem;">
                    Lưu ý : Nếu không cập nhật mật khẩu vui lòng để trống trường trên
                </p>
                <div class="order__form--for">
                    <div>
                        <input @change="onChangeGender($event)" v-model="gender" value="Nam" type="radio"
                            name="order-gender" id="">
                        <label for="">Nam</label>
                    </div>
                    <div>
                        <input @change="onChangeGender($event)" v-model="gender" value="Nữ" type="radio"
                            name="order-gender" id="">
                        <label for="">Nữ</label>
                    </div>
                    <div>
                        <input @change="onChangeGender($event)" v-model="gender" value="Khác" type="radio"
                            name="order-gender" id="">
                        <label for="">Khác</label>
                    </div>
                </div>
                <InputComponent type="text" placeholder="Nhập số điện thoại" icon="bx bx-phone" :value="phone.value"
                    :errorMessage="!phone.error ? '' : phone.error === 1 ? 'Số điện thoại không được trống' :
                    'Số điện thoại không đúng định dạng'" :onChange="onChange" name="phone">
                </InputComponent>
                <InputComponent type="text" placeholder="Nhập email" icon="bx bx-envelope" :value="email.value"
                    :errorMessage="!email.error ? '' : email.error === 1 ? 'Email không được trống' : 'Emal không đúng định dạng'"
                    :onChange="onChange" name="email">
                </InputComponent>
                <button @click="updateInfo" v-if="!loadingButtonInfo" class="profile__top--left--button"
                    :class="loadingButtonInfo ? 'disabled' : ''">
                    Cập nhật
                </button>
                <button v-else class="profile__top--left--button" disabled>
                    <span class="bx bx-loader loading"></span>
                </button>
            </div>
            <div class="profile__top--right">
                <div class="profile__top--right--image">
                    <img :src="image.file ? image.value : (urlImage + user.avatar)" alt="" srcset="">
                </div>
                <input type="file" @change="onChangeImage($event)" hidden id="avatar-update">
                <ul>
                    <li style="cursor: pointer;">
                        <label v-if="!image.file" for="avatar-update">
                            Chọn file
                        </label>
                        <label @click="resetImage" v-else>
                            Mặc định
                        </label>
                    </li>
                    <li>
                        <button @click="updateAvatar" :class="image.file ? '' : 'disabled'">
                            <span :class="loadingButtonAvatar ? 'bx bx-loader loading' : ''">
                                {{ loadingButtonAvatar ? '' : 'Cập nhật' }}
                            </span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <p class="profile__title">Lịch đặt khám</p>
        <div class="profile__content">
            <ItemBookList v-for="item in list" :key="item.id" :item="item" :setIdBookList="setIdBookList"
                :setIdDoctor="setIdDoctor" />
        </div>
    </div>
    <div v-else class="loading__content">
        <span class="bx bx-loader loading"></span>
    </div>
    <ModalReplyBookList v-if="modalUser.data" :iddoctor="iddoctor" :idbooklist="idbooklist" :setList="setList">
    </ModalReplyBookList>
    </div>
</template>
<script>
import { mapMutations, mapState } from 'vuex';
import Request from '../../Request';
import ItemBookList from './components/ItemComponent/ItemBookList.vue';
import InputComponent from '../manage/InputComponent.vue';
import { REGEX_EMAIL, REGEX_NUMBER_PHONE, URL_IMAGE } from '../../Config';
import ModalReplyBookList from './modal/ModalReplyBookList.vue';

export default {
    components: { ItemBookList, InputComponent, ModalReplyBookList },
    data() {
        return {
            idbooklist: [],
            iddoctor: [],
            list: [],
            loading: true,
            fullname: {
                value: '',
                error: ''
            },
            loadingButtonAvatar: false,
            loadingButtonInfo: false,
            password: {
                value: ''
            },
            phone: {
                value: '',
                error: ''
            },
            email: {
                value: '',
                error: ''
            },
            image: {
                file: null,
                value: ''
            },
            gender: 'Nam',
            urlImage: URL_IMAGE
        }
    },
    methods: {
        ...mapMutations(['setuser']),
        updateInfo: async function () {
            this.loadingButtonInfo = true;
            try {
                const result = await Request.Put('/users', {
                    id: this.user.id,
                    fullname: this.fullname.value,
                    password: this.password.value,
                    updatePassword: this.password.value.length === 0 ? 'false' : 'true',
                    gender: this.gender,
                    phone: this.phone.value,
                    email: this.email.value
                });
                this.setuser(result.data.data);
                this.loadingButtonInfo = false;
            } catch (error) {
                alert(error);
            }
        },
        setIdDoctor: function (id) {
            this.iddoctor = id;
        },
        setIdBookList: function (id) {
            this.idbooklist = id;
        },
        setList: function (id) {
            let clone = [...this.list];
            let index = clone.findIndex(dt => dt.idbooklist_main === id);
            if (index !== -1) {
                clone[index].status_book_list = 3;
                this.list = clone;
            }
        },
        onChange: function (event) {
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
                case "password":
                    break;
                default:
                    this[event.target.name].error = event.target.value.length === 0
                    break;
            }
        },
        updateAvatar: async function () {
            this.loadingButtonAvatar = true;
            if (this.image.file) {
                //
                try {
                    const formData = new FormData();
                    formData.append('image', this.image.file);
                    const image = await Request.Post('/uploadImage', formData);
                    const result = await Request.Post('/user-avatar', {
                        image: image.data.data,
                        id: this.user.id,
                        current: this.user.avatar
                    });
                    this.image.file = null;
                    this.setuser(result.data.data);
                    this.loadingButtonAvatar = false;
                } catch (error) {
                    alert(error);
                }
            }
        },
        fetchData: async function (user) {
            try {
                if (user) {
                    const result = await Request.Get(`/booklist-user/${user.id}`);
                    this.list = result.data.data;
                    this.fullname.value = user.fullname;
                    this.phone.value = user.phone;
                    this.email.value = user.email;
                    this.gender = user.gender;
                    this.image.value = user.avatar;
                    this.loading = false;
                }
            } catch (error) {
                alert(error);
            }
        },
        onChangeGender: function (event) {
            this.gender = event.target.value;
        },
        onChangeImage: function (event) {
            const files = event.target.files;
            if (files.length > 0) {
                this.image.value = URL.createObjectURL(files[0]);
                this.image.file = files[0];
            }
        },
        resetImage: function () {
            this.image.file = null;
        }
    },
    computed: {
        ...mapState(['user', 'modalUser'])
    },
    mounted() {
        this.fetchData(this.user);
    },
    watch: {
        user: function (newData) {
            this.fetchData(newData);
        },
        modalUser: function () {

        }
    }
}
</script>