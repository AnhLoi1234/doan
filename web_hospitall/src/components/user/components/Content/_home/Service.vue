<template>
    <div class="wrapper service">
        <p class="item__post--heading">
            Xem nhiều nhất
        </p>
        <div class="row">
            <div class="service__slider">
                <router-link v-for="item in list" :key="item.id" to="" class="service__slider--item">
                    <span class="service__slider--item--sticky">
                        MỚI NHẤT
                    </span>
                    <div class="service__slider--item--image">
                        <div class="img-wrap">
                            <img :src="urlImage + item.thumbnail" alt="" srcset="">
                        </div>
                    </div>
                    <h3>{{ item.title }}</h3>
                    <br />
                    <p>XEM CHI TIẾT <span class="bx bx-chevrons-right"></span></p>
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
import { URL_IMAGE } from '../../../../../Config';
import Request from '../../../../../Request';

export default {
    data() {
        return {
            urlImage: URL_IMAGE,
            list: []
        }
    },
    mounted() {
        (async () => {
            try {
                const result = await Request.Get('/blogs');
                this.list = result.data.data;
            } catch (error) {
                alert(error);
            }
        })()
    }
}
</script>