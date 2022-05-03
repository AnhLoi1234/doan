<template>
    <div class="container">
        <div class="header">
            <h1> ADMIN ĐĂNG NHẬP</h1>
        </div>
        <div class="screen">
            <div class="screen__content">
                <form class="login" method="post">
                    <div class="login__field">
                        
                        <input type="text" class="login__input" placeholder="Tên đăng nhập ">
                    </div>
                    <div class="login__field">
                        
                        <input type="password" class="login__input" placeholder="Mật khẩu">
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
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>		
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>		
        </div>
    </div>
</template>
<style scoped src = '@/assets/styles/admin/Login.css'></style>