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
            <div class="header__support" @click="this.$router.push({ name: (user ? 'Profile' : 'Login') })">
                <i class='bx bxs-user' style='color:#318c9c'></i>
                <span>{{ user ? user.fullname : "Đăng nhập" }}</span>
            </div>
            <div @click="logout()" v-if="user != null" class="header__support">
                <i class='bx bx-exit' style='color:#318c9c'></i>
                <span></span>
            </div>
        </div>
        <div class="header__menu" :class="isActive ? 'active' : ''">
            <ul>
                <li>
                    <router-link @click="isActive = !isActive" :to="{
                        name: 'User_Home'
                    }">
                        Trang chủ
                    </router-link>
                </li>
                <li v-if="user">
                    <router-link @click="isActive = !isActive" :to="{
                        name: 'Profile',
                        params: {
                            id: this.user.id
                        }
                    }">
                        Cập nhật thông tin cá nhân
                    </router-link>
                </li>
                <li>
                    <router-link @click="isActive = !isActive" :to="{
                        name: 'DoctorList'
                    }">
                        Bác sĩ
                    </router-link>
                </li>
                <li>
                    <router-link @click="isActive = !isActive" :to="{
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
import { mapState, mapMutations } from 'vuex'
export default {
    data() {
        return {
            isActive: false
        }
    },
    computed: {
        ...mapState(['user'])
    },
    methods: {
        ...mapMutations(['setuser']),
        logout: function () {
            let auth = confirm('Bạn có muốn đăng xuất?')
            if (auth) {
                window.localStorage.removeItem('K-user')
                this.setuser(null)
                this.$router.push({ name: 'Login' });
            }
        }
    }
}
</script>