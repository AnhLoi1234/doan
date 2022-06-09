<template>
    <div class="banner">
        <div class="banner__image img-wrap">
            <img src="@/assets/img/banner/banner.jpg" alt="">
        </div>
        <div class="banner__search">
            <h2>NỀN TẢNG Y TẾ</h2>
            <h1>CHĂM SÓC SỨC KHỎE TOÀN DIỆN</h1>
            <div class="banner__search--input col-md-4">
                <input type="text" placeholder="Tìm chuyên khoa" style="color:#000;" @keyup="onKeyUp($event)">
                <i class="bx bx-search"></i>
                <!-- <div class="banner__search--popup">
                    <ul>
                        <li class="active">Chuyên khoa</li>
                        <li>Cơ xương khớp</li>
                        <li>Thần kinh</li>
                        <li>Tiêu hoá</li>
                        <li>Cơ xương khớp</li>
                        <li>Thần kinh</li>
                        <li>Tiêu hoá</li>
                        <li>Cơ xương khớp</li>
                        <li>Thần kinh</li>
                        <li>Tiêu hoá</li>
                        <li>Cơ xương khớp</li>
                        <li>Thần kinh</li>
                        <li>Tiêu hoá</li>
                        <li>Cơ xương khớp</li>
                        <li>Thần kinh</li>
                        <li>Tiêu hoá</li>
                        <li>Cơ xương khớp</li>
                        <li>Thần kinh</li>
                        <li>Tiêu hoá</li>
                    </ul>
                </div> -->
            </div>
        </div>
        <ModalListOption v-if="modalUser.data" :namespecical="namespecical"></ModalListOption>
        <!-- <div class="banner__option--container">
            <div class="wrapper banner__option">
                <a href="" class="banner__option--item">
                    <div class="">
                        <img src="@/assets/img/banner/banner_item-01.png" alt="">
                    </div>
                    <p>
                        <span>Khám</span>
                        <span>Chuyên khoa</span>
                    </p>
                </a>
                <a href="" class="banner__option--item">
                    <div class="">
                        <img src="@/assets/img/banner/banner_item-01.png" alt="">
                    </div>
                    <p>
                        <span>Khám</span>
                        <span>Chuyên khoa</span>
                    </p>
                </a>
                <a href="" class="banner__option--item">
                    <div class="">
                        <img src="@/assets/img/banner/banner_item-01.png" alt="">
                    </div>
                    <p>
                        <span>Khám</span>
                        <span>Chuyên khoa</span>
                    </p>
                </a>
                <a href="" class="banner__option--item">
                    <div class="">
                        <img src="@/assets/img/banner/banner_item-01.png" alt="">
                    </div>
                    <p>
                        <span>Khám</span>
                        <span>Chuyên khoa</span>
                    </p>
                </a>
                <a href="" class="banner__option--item">
                    <div class="">
                        <img src="@/assets/img/banner/banner_item-01.png" alt="">
                    </div>
                    <p>
                        <span>Khám</span>
                        <span>Chuyên khoa</span>
                    </p>
                </a>
                <a href="" class="banner__option--item">
                    <div class="">
                        <img src="@/assets/img/banner/banner_item-01.png" alt="">
                    </div>
                    <p>
                        <span>Khám</span>
                        <span>Chuyên khoa</span>
                    </p>
                </a>
                <a href="" class="banner__option--item">
                    <div class="">
                        <img src="@/assets/img/banner/banner_item-01.png" alt="">
                    </div>
                    <p>
                        <span>Khám</span>
                        <span>Chuyên khoa</span>
                    </p>
                </a>
                <a href="" class="banner__option--item">
                    <div class="">
                        <img src="@/assets/img/banner/banner_item-01.png" alt="">
                    </div>
                    <p>
                        <span>Khám</span>
                        <span>Chuyên khoa</span>
                    </p>
                </a>
            </div>
        </div> -->
    </div>
</template>
<script>
import { mapMutations, mapState } from 'vuex';
import ModalListOption from '../../../modal/ModalListOption.vue';
export default {
    data() {
        return {
            namespecical: ''
        }
    },
    methods: {
        ...mapMutations(['setModalUser']),
        onKeyUp: function (event) {
            if (event.keyCode === 13) {
                //
                this.setModalUser({ ...this.modalUser, data: true });
                this.namespecical = event.target.value;
            }
        }
    },
    computed: {
        ...mapState(['modalUser'])
    },
    components: { ModalListOption }
}
</script>