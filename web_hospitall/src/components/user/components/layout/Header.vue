<template>
    <header id="header" class="header">
        <div class="wrapper header__content">
            <div class="header__icon">
                <span @click="isActive = !isActive" class="bx bx-menu"></span>
            </div>
            <div class="header__logo">
                <router-link :to="{ name: 'User_Home' }">
                    <img src="@/assets/img/logo/logo.svg" alt="" srcset="">
                </router-link>
            </div>
            <ul class="header__list">
                <li class="hide-show">
                    <p>Chuyên khoa</p>
                    <p>Tìm bác sỹ theo chuyên khoa</p>
                </li>
                <li class="hide-show">
                    <p>Chuyên khoa</p>
                    <p>Tìm bác sỹ theo chuyên khoa</p>
                </li>
                <li class="hide-show">
                    <p>Chuyên khoa</p>
                    <p>Tìm bác sỹ theo chuyên khoa</p>
                </li>
                <li class="hide-show">
                    <p>Chuyên khoa</p>
                    <p>Tìm bác sỹ theo chuyên khoa</p>
                </li>
            </ul>
            <div class="header__support" @click="this.$router.push({ name: (user ? '' : 'Login') })">
                <i class='bx bxs-user' style='color:#318c9c'></i>
                <span>{{ user ? user.fullname : "Đăng nhập" }}</span>
            </div>
        </div>
        <div class="header__menu" :class="isActive ? 'active' : ''">
            <ul>
                <li>
                    <router-link :to="{
                        name: 'User_Home'
                    }">
                        Trang chủ
                    </router-link>
                </li>
                <li>
                    <router-link :to="{
                        name: 'Doctors'
                    }">
                        Bác sĩ
                    </router-link>
                </li>
                <li>
                    <router-link :to="{
                        name: 'Blogs'
                    }">
                        Bài viết
                    </router-link>
                </li>
            </ul>
        </div>
        <div @click="isActive = false" class="header__menu--overlay" :class="isActive ? 'active' : ''">
        </div>
    </header>
</template>
<script>
import { mapState } from 'vuex'
export default {
    data() {
        return {
            isActive: false
        }
    },
    computed: {
        ...mapState(['user'])
    }
}
</script>