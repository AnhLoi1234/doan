<template>
    <InputComponent :placeholder="'Nhập họ tên'" type="text" name="fullname" :errorMessage="`${fullname.error ?
    'Họ tên không được trống' : ''}`" :onChange="onChange" icon="bx bx-user" :value="fullname.value" :disabled="user">
    </InputComponent>
    <InputComponent :placeholder="'Nhập số điện thoại'" type="text" name="phone" :errorMessage="`${!phone.error ? '' : phone.error ===
    2 ? 'Số điện thoại không đúng định dạng' : 'Số điện thoại không được trống'}`" icon="bx bx-phone"
        :value="phone.value" :onChange="onChange" :disabled="user"></InputComponent>
    <br />
    <button @click="onSubmit" class="order__form--button">Tiếp tục</button>
</template>
<script>
import { mapState } from 'vuex';
import { REGEX_NUMBER_PHONE } from '../../../../Config';
import InputComponent from '../../../manage/InputComponent.vue';
import Request from '../../../../Request';
export default {
    props: ['setIsLogin', 'setDoctor', 'id', 'isLogin'],
    components: { InputComponent },
    computed: {
        ...mapState(['socket', 'user'])
    },
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
        onSubmit: async function () {
            this.fullname.error = this.fullname.value.length === 0
            this.phone.error = this.phone.value.length === 0 ? 1 :
                !this.phone.value.match(REGEX_NUMBER_PHONE) ? 2 : false

            if (!this.fullname.error && !this.phone.error) {
                this.setIsLogin(1);
                const result = await Request.Get('/doctor-random');
                if (result.data.data) {
                    this.setDoctor(result.data.data);
                    this.socket.emit('requestJoin', {
                        fullname: this.fullname.value,
                        phone: this.phone.value,
                        id: result.data.data?.idadmin,
                        userS: this.id,
                        groupChat: null
                    })
                }
                else {
                    alert('Hiện tại các bác sĩ đều bận . Vui lòng thử lại sau');
                    this.setIsLogin(0)

                }
            }
        }
    },
    watch: {
        user: function (newData) {
            if (newData) {
                this.fullname.value = newData?.fullname;
                this.phone.value = newData?.phone;
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
    },
    mounted() {
        this.fullname.value = this.user?.fullname;
        this.phone.value = this.user?.phone;
    }
}
</script>