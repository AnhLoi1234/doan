<template>

<div class="container">
	<Loading v-if="loading"></Loading>
    <div class="header">
        <h1> ĐĂNG NHẬP TRANG QUẢN LÝ</h1>
    </div>
	<div class="screen">
		<div class="screen__content">
			<form class="login" method="post" @submit.prevent="login()">
				<p class="error_login">{{status}}</p>
				<div class="login__field">
					<input type="text" class="login__input" v-model="account.username" placeholder="Tên đăng nhập ">
					<p>{{errors.username}}</p>
				</div>
				<div class="login__field">
					<input type="password" v-model="account.password" class="login__input" placeholder="Mật khẩu">
					<p>{{errors.password}}</p>
				</div>
                <div class="input_passwork">
                    <input type="checkbox">Nhớ mật khẩu
                </div>
				<button class="button login__submit" type="submit">
					<span class="button__text">ĐĂNG NHẬP</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>
			<div class="social-login">
				
			</div>
		</div>
		<div class="screen__background">aksjfal
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</template>
<script>
import Request from '@/Request';
import Loading from '@/components/Loading';
export default {
	data() {
		return {
			loading:false,
			account:{
				username:'',
				password:'',
			},
			errors:{},
			status:''
		}
	},
	components:{
		Loading
	},
	methods:{
		login:async function(){
			this.loading = true;
			this.status = '';
			this.errors = {};
			try {
				const res = await Request.login('/admin-login',this.account);
				window.localStorage.setItem('K-admin', res.data.token);
				if(res.data.role == '0'){
					this.$router.push({name:'manage'})
				}
				else{
					alert('Chưa làm')
				}
				
				this.loading = false;
			} catch (error) {
				if(error.response.status == 500) {
					this.status = 'Không thể kết nối đến server';
					this.loading = false;
					return
				}
				this.status = error.response.data.message;
				this.loading = false;
				// this.errors = error.response.data.errors;
				console.log(error);
				this.errors.username = error.response.data.errors.username?.[0];
				this.errors.password = error.response.data.errors.password?.[0];
				
			}
			// Request.login('/admin-login',this.account)
			// .then(response => {
			// 	window.localStorage.setItem('token', response.data.token);
			// 	this.$router.push({name:'manage'})
			// 	this.loading = false;
			// })
			// .catch(er =>{
			// 	if(!er.response){
			// 		console.log('bug')
			// 	}
			// 	console.log(er)
			// })
		},
	}
}
</script>
<style scoped src ='@/assets/style/manage/Login.css'></style>