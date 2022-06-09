<template>
    <div class="wrapper service">
        <p class="item__post--heading">
            Công nghệ y học
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
                    <h3 @click="handleClick(item)">{{ item.title }}</h3>
                    <!-- <ul>
                        <li>Tầm soát và xác định COVID-19</li>
                        <li>Tầm soát và xác định COVID-19</li>
                        <li>Tầm soát và xác định COVID-19</li>
                    </ul>
                    <p>XEM CHI TIẾT <span class="bx bx-chevrons-right"></span></p> -->
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
    methods: {
        handleClick: function (item) {
            this.$router.push({
                name: 'BlogDetail', params: {
                    slug: item.slug_blog
                }
            })
        }
    },
    mounted() {
        (async () => {
            try {
                const result = await Request.Get('/blog-user/1');
                this.list = result.data.data;
            } catch (error) {
                alert(error);
            }
        })()
    }
}
</script>