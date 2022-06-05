<template>
    <InputComponent :placeholder="'Nhập họ tên'" type="text" name="fullname" :errorMessage="`${fullname.error ?
    'Họ tên không được trống' : ''}`" :onChange="onChange" icon="bx bx-user" :value="fullname.value">
    </InputComponent>
    <InputComponent :placeholder="'Nhập số điện thoại'" type="text" name="phone" :errorMessage="`${!phone.error ? '' : phone.error ===
    2 ? 'Số điện thoại không đúng định dạng' : 'Số điện thoại không được trống'}`" icon="bx bx-phone"
        :value="phone.value" :onChange="onChange"></InputComponent>
    <br />
    <button @click="onSubmit" class="order__form--button">Tiếp tục</button>
</template>
<script>
import { REGEX_NUMBER_PHONE } from '../../../../Config';
import InputComponent from '../../../manage/InputComponent.vue';
export default {
    props: ['setIsLogin'],
    components: { InputComponent },
    methods: {
        onChange: function (event) {
            this[event.target.name].value = event.target.value;
            switch (event.target.name) {
                case 'phone':
                    this[event.target.name].error = event.target.value.length === 0 ? 1 :
                        !event.target.value.match(REGEX_NUMBER_PHONE) ? 2 : false
                    break;
                default:
                    this[event.target.name].error = event.target.value.length === 0
                    break;
            }
        },
        onSubmit: function () {
            this.fullname.error = this.fullname.value.length === 0
            this.phone.error = this.phone.value.length === 0 ? 1 :
                !this.phone.value.match(REGEX_NUMBER_PHONE) ? 2 : false

            if (!this.fullname.error && !this.phone.error) {
                this.setIsLogin(true);
            }
        }
    },
    data() {
        return {
            fullname: {
                value: '',
                error: false
            },
            phone: {
                value: '',
                error: false
            }
        }
    }
}
</script>