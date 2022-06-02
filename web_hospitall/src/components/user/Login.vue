<template>
    <div class="login" id="login">
        <div class="login__container">
            <h2>MH Care</h2>
            <P style="color:red">{{ messageError.mes }}</P>
            <div>
                <span class="bx bx-user"></span>
                <input :class="{ 'error': messageError.email }" v-model="account.email" type="text"
                    placeholder="Địa chỉ email">
                <p>{{ messageError.email }}</p>
            </div>
            <div>
                <span class="bx bx-lock"></span>
                <input :class="{ 'error': messageError.password }" v-model="account.password" type="password"
                    placeholder="Mật khẩu">
                <p>{{ messageError.password }}</p>
            </div>
            <div>
                <button @click="Login()">Đăng nhập</button>
            </div>
            <p>
                <router-link :to="{ name: 'Register' }">Đăng ký</router-link>
            </p>
        </div>
    </div>
</template>

<script>
import Request from '@/Request'
import { mapMutations } from 'vuex'
export default {
    data() {
        return {
            account: {
                email: '',
                password: '',
            },
            messageError: {}
        }
    },
    // computed:{
    //     ...mapState([User_load])
    // }
    methods: {
        ...mapMutations(['setuserLoad', 'setuser']),
        Login: function () {
            this.messageError = {}
            this.setuserLoad(true);
            Request.Post('/user-login', this.account)
                .then((res) => {
                    this.setuserLoad(false);
                    window.localStorage.setItem('K-user', res.data.token);
                    this.setuser(res.data)
                    this.$router.push({ name: 'User_Home' })
                })
                .catch((err) => {
                    this.setuserLoad(false);
                    if (err.response.status == 500) {
                        this.status = 'Không thể kết nối đến server';
                        this.loading = false;
                        return
                    }
                    console.log(err);
                    this.messageError.mes = err.response.data.message
                    this.messageError.email = err.response.data.errors.email?.[0];
                    this.messageError.password = err.response.data.errors.password?.[0];
                })
        }
    }
}
</script>