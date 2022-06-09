<template>
    <div class="admin type02">
        <div class="admin__header">
            <div class="admin__header--logo">
                <a href="">
                    <img src="@/assets/img/logo/logo.svg" alt="MH CARE">
                </a>
                <span class="bx bx-menu box-icon" @click="toggleMenu"></span>
            </div>
            <div class="admin__header--content">
                <div class="admin__header--search">
                    <span class="bx bx-search"></span>
                    <input type="text" placeholder="Search">
                    <span class="bx bx-x"></span>
                </div>
                <div class="admin__header--right">
                    <span class="bx bx-bell box-icon"></span>
                    <div>
                        <img :src="admin?.role == 0 ? 'https://berrydashboard.io/static/media/user-round.13b5a31b.svg' : urlImage + 'avatar-default.jpeg'"
                            alt="" srcset="">
                        <span @click="handleInfo" v-if="admin?.role == 1" class="bx bx-user-pin"></span>
                        <span @click="logOut" class="bx bx-log-out"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ModalDoctor v-if="admin?.role == 1 && modal.info && modal.data" :id="admin?.id"></ModalDoctor>
</template>
<script>
import { mapMutations, mapState } from 'vuex'
import { inject } from 'vue'
import { URL_IMAGE } from '../../../Config';
import ModalDoctor from '../modal/ModalDoctor.vue';
export default {
    components: {
        ModalDoctor
    },
    setup() {
        const slideMenu = inject('btn_menu');
        return { slideMenu };
    },
    computed: {
        ...mapState(['admin', 'modal']),
    },
    data() {
        return {
            urlImage: URL_IMAGE
        }
    },
    methods: {
        ...mapMutations(['setadmin', 'setModal']),
        toggleMenu: function () {
            // this.slideMenu.classList.toggle('active');
            this.slideMenu = !this.slideMenu
        },
        handleInfo: function () {
            this.setModal({ ...this.modal, info: true, data: true });
        },
        logOut: function () {
            this.setadmin(null);
            window.localStorage.removeItem('K-admin');
            this.$router.push({ name: 'admin_login' })
        }
    }
}
</script>
