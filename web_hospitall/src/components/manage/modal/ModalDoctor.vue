<template>
    <ModalAdmin :title="'Bác sĩ'" :nameButton="edit === 3 ? `${id ? 'Sửa' : 'Thêm'} bác sĩ` : 'Tiếp tục'">
        <div class="specicallist flex-space-between">
            <label v-if="edit !== 1" class="left-0" @click="writeDescription(edit - 1)" for="">
                Trở về
            </label>
            <label v-if="edit !== 3" class="right-0" @click="writeDescription(edit + 1)" for="">
                Tiếp tục
            </label>
        </div>
        <br />
        <div v-if="edit === 1">
            <div class="flex">
                <div class="w-50">
                    <InputComponent placeholder="Nhập tên bác sĩ" type="text" icon="bx bx-user"
                        :errorMessage="nameDoctor.error ? 'Tên bác sĩ không được trống' : ''" :onChange="onChange"
                        name="nameDoctor" :value="nameDoctor.value">
                    </InputComponent>
                </div>
                <div class="w-50">
                    <InputComponent placeholder="Nhập tên đăng nhập" type="text" icon="bx bx-user"
                        :errorMessage="username.error ? 'Tên đăng nhập không được trống' : ''" :onChange="onChange"
                        name="username" :value="username.value">
                    </InputComponent>
                </div>
            </div>
            <div class="flex">
                <div class="w-50">
                    <InputComponent placeholder="Nhập số điện thoại" type="text" icon="bx bx-phone" :errorMessage="!phone.error ? '' : phone.error === 1 ? 'Số điện thoại không được trống' :
                    'Số điện thoại không đúng định dạng'" :onChange="onChange" name="phone" :value="phone.value">
                    </InputComponent>
                </div>
                <div class="w-50">
                    <InputComponent placeholder="Nhập email" type="text" icon="bx bx-envelope" :errorMessage="!email.error ? '' :
                email.error === 1 ? 'Email không được trống' :
                    'Email không đúng định dạng'" :onChange="onChange" name="email" :value="email.value">
                    </InputComponent>
                </div>
            </div>
            <p style="padding-bottom: 1rem;font-size: 1.5rem;font-weight:600;">Chuyên khoa</p>
            <div class="select_admin">
                <select>
                    <option value="">Thần kinh</option>
                </select>
                <span class="bx bx-chevron-down"></span>
            </div>
            <p class="color-red"></p>
            <br />
            <div class="specicallist">
                <img :src="image.value || 'https:\\via.placeholder.com/200x200'"
                    style="width: 20rem;height:20rem;object-fit:cover;border-radius:100rem;" alt="" srcset="">
                <input type="file" @change="onChangeImage($event)" hidden id="select-file">
                <label for="select-file">
                    Chọn ảnh bác sĩ
                </label>
            </div>
        </div>
        <div v-if="edit === 2">
            <VueEditor />
        </div>
        <div v-if="edit === 3">
            <div class="select-list">
                <div class="item-select">
                    Thứ 3 - 05/06
                </div>
                <div class="item-select">
                    Thứ 3 - 05/06
                </div>
            </div>
            <div class="flex">
                <div class="w-50">
                    <div class="order__form--input">
                        <div class="select_admin">
                            <select>
                                <option value="">Thần kinh</option>
                            </select>
                            <span class="bx bx-chevron-down"></span>
                        </div>
                    </div>
                </div>
                <div class="w-50">
                    <InputComponent placeholder="Nhập ngày" type="text" icon="bx bx-calendar"
                        :errorMessage="nameDoctor.error ? '' : ''" :onChange="onChange" name="nameDoctor">
                    </InputComponent>
                </div>
            </div>
            <div class="flex">
                <div class="w-50">
                    <InputComponent placeholder="Nhập tháng" type="text" icon="bx bx-calendar"
                        :errorMessage="nameDoctor.error ? '' : ''" :onChange="onChange" name="nameDoctor">
                    </InputComponent>
                </div>
                <div class="specicallist w-50">
                    <label for="select-file">
                        Thêm thời gian
                    </label>
                </div>
            </div>
        </div>
    </ModalAdmin>
</template>
<script>
import ModalAdmin from "../ModalAdmin.vue";
import InputComponent from "../InputComponent.vue";
import { mapMutations, mapState } from "vuex";
import { VueEditor } from "vue3-editor";
import { REGEX_EMAIL, REGEX_NUMBER_PHONE } from "../../../Config";

export default {
    props: ['id'],
    components: {
        InputComponent,
        ModalAdmin,
        VueEditor
    },
    data() {
        return {
            edit: 1,
            nameDoctor: {
                value: '',
                error: false
            },
            username: {
                value: '',
                error: ''
            },
            phone: {
                value: '',
                error: ''
            },
            email: {
                value: '',
                error: ''
            },
            specicallist: {
                value: '',
                error: ''
            },
            description: {
                value: '',
                error: ''
            },
            listTime: [],
            image: {
                value: '',
                file: null,
            }
        }
    },
    methods: {
        ...mapMutations(['setModal']),
        setLoading: function (status) {
            this.setModal({ ...this.modal, loading: status })
        },
        writeDescription: function (edit) {
            this.edit = edit;
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
                default:
                    this[event.target.name].error = event.target.value.length === 0
                    break;
            }
        },
        onChangeImage: function (event) {
            this.image.value = URL.createObjectURL(event.target.files[0]);
            this.image.file = event.target.files[0];
        }
    },
    computed: {
        ...mapState(['modal'])
    },
    mounted() {
        (async () => {
            this.setLoading(false);
        })();
    }

}
</script>