<template>
    <router-link :to="{
        name: 'BlogDetail', params: {
            slug: item.slug_blog
        }
    }" href="" class="service__slider--item">
        <!-- <span class="service__slider--item--sticky">
            COVID
        </span> -->
        <div class="service__slider--item--image">
            <div class="img-wrap">
                <img :src="urlImage + item.thumbnail" alt="" srcset="">
            </div>
        </div>
        <h3>{{ item.title }}</h3>
        <!-- <ul>
            <li>Tầm soát và xác định COVID-19</li>
            <li>Tầm soát và xác định COVID-19</li>
            <li>Tầm soát và xác định COVID-19</li>
        </ul>
        <p>XEM CHI TIẾT <span class="bx bx-chevrons-right"></span></p> -->
    </router-link>
</template>
<script>
import { URL_IMAGE } from '../../../../Config'

export default {
    props: ['item'],
    data() {
        return {
            urlImage: URL_IMAGE
        }
    }
}
</script>