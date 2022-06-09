<template>
    <div class="login" id="login">
        <div class="confirm__wrap" v-if="formConfirm">
            <div class="confirm">
                <h2>Mã xác nhận đã được gửi tới:<br> <span>{{account.email}}</span></h2>
                <input v-model="code" type="number" name="" id="" placeholder="Gồm 6 số">
                <div class="btn">
                    <button :disabled="Check" @click="Confirm()">XÁC NHẬN</button>
                    <button @click="formConfirm = false">HỦY</button>
                </div>
            </div>
        </div>
        <div class="login__container">
            <h2>MH Care</h2>
            <div>
                <input :class="{'error':messageError.fullname}" type="text" v-model="account.fullname" placeholder="Họ và tên">
                <span class="bx bx-user"></span>
                <p>{{messageError.fullname}}</p>
            </div>
            <div>
                <span class="bx bx-male-female"></span>
                <select :class="{'error':messageError.gender}" v-model="account.gender" name="" id="">
                    <option value="" disabled>Chọn giới tính</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
                <p>{{messageError.gender}}</p>
            </div>
            <div>
                <span class="bx bx-user-pin"></span>
                <input :class="{'error':messageError.email}" type="email" placeholder="Email" v-model="account.email">
                <p>{{messageError.email}}</p>
            </div>
            <div>
                <span class="bx bx-lock"></span>
                <input :class="{'error':messageError.password}" type="password" placeholder="Mật khẩu" v-model="account.password">
                <p>{{messageError.password}}</p>
            </div>
            <div>
                <span class="bx bx-phone"></span>
                <input :class="{'error':messageError.phone}" type="number" placeholder="Số điện thoại" v-model="account.phone">
                <p>{{messageError.phone}}</p>
            </div>
            <div>
                <button @click="Register()">Đăng ký</button>
            </div>
            <p><router-link :to="{name:'Login'}">Đăng nhập</router-link></p>
        </div>
    </div>
</template>
<script>
import Request from '@/Request'
import {mapState, mapMutations} from 'vuex'
export default {
    data() {
        return {
            account:{
                fullname:'',
                gender:'',
                email:'',
                password:'',
                phone:'',
            },
            messageError:{},
            code:'',
            formConfirm:false,
            Check:true,
        }
    },
    computed:{
        ...mapState(['User_load']),
    },
    methods: {
        ...mapMutations(['setuserLoad']),
        Register:function() {
            this.messageError ={}
            this.setuserLoad(true)
            Request.Post('/user-register-check',this.account)
            .then((res) =>{
                this.setuserLoad(false);
                if(res.data == 1){
                    this.formConfirm = true;
                }
            })
            .catch((err) =>{
                this.setuserLoad(false);
                if(err.response.status == 500) {
                    this.status = 'Không thể kết nối đến server';
                    this.loading = false;
                    return
                }
                this.messageError.fullname = err.response.data.errors.fullname?.[0];
                this.messageError.email = err.response.data.errors.email?.[0];
                this.messageError.gender = err.response.data.errors.gender?.[0];
                this.messageError.password = err.response.data.errors.password?.[0];
                this.messageError.phone = err.response.data.errors.phone?.[0];
            })
        },
        Confirm(){
            this.setuserLoad(true),
            this.account.code = this.code,
            Request.Post('/user-register',this.account)
            .then((res) =>{
                alert('Đăng ký thành công vui lòng đăng nhập lại')
                console.log(res)
                this.setuserLoad(false)
                this.formConfirm = false
                this.$router.push({name:'Login'})
            })
            .catch(() =>{
                alert('Mã xác nhận không chính xác vui lòng kiểm tra lại.')
                this.setuserLoad(false)
            })
        }
    },
    watch:{
        code:function() {
            if(this.code.toString().length == 6){
                this.Check = false;
            }
            else{
                this.Check = true;
            }
        }
    }
}
</script>