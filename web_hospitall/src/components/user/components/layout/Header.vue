<template>
    <header id="header" class="header">
        <div class="wrapper header__content">
            <div class="header__icon">
                <span class="bx bx-menu"></span>
            </div>
            <div class="header__logo">
                <router-link :to="{name:'User_Home'}">
                    <img src="@/assets/img/logo/logo.svg" alt="" srcset="">
                </router-link>
            </div>
            <ul class="header__list">
                <li>
                    <p>Chuyên khoa</p>
                    <p>Tìm bác sỹ theo chuyên khoa</p>
                </li>
                <li>
                    <p>Chuyên khoa</p>
                    <p>Tìm bác sỹ theo chuyên khoa</p>
                </li>
                <li>
                    <p>Chuyên khoa</p>
                    <p>Tìm bác sỹ theo chuyên khoa</p>
                </li>
                <li>
                    <p>Chuyên khoa</p>
                    <p>Tìm bác sỹ theo chuyên khoa</p>
                </li>
            </ul>
            <div class="header__support">
                <router-link :to="{ name: (user ? '' :'Login')}">
                    <i class='bx bxs-user' style='color:#318c9c'></i>
                    <span>{{user ? user.fullname : "Đăng nhập"}}</span>
                </router-link>
            </div>
        </div>
        <div class="header__menu">
            <ul>
                <li><a href="">
                        Trang chủ
                    </a></li>
                <li><a href="">
                        Trang chủ
                    </a></li>
                <li><a href="">
                        Trang chủ
                    </a></li>
                <li>
                    <div>VỀ BOOKINGCARE</div>
                </li>
                <li>
                    <a href="">Về cho bệnh nhân</a>
                </li>
                <li>
                    <a href="">Về cho bác sỹ</a>
                </li>
            </ul>
        </div>
        <div class="header__menu--overlay">
        </div>
    </header>
</template>
<script>
import { mapState } from 'vuex'
export default {
    data() {
        return {}
    },
    computed:{
        ...mapState(['user'])
    }
}
</script>
<style scoped src = '@/assets/style/user/components/layout/Header.css'>
</style>