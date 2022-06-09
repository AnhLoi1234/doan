<template>
    <router-link :to="{
        name: 'BlogDetail', params: {
            slug: item.slug_blog
        }
    }" class="blog__detail--item">
        <div class="service__slider--item--image">
            <div class="img-wrap">
                <img :src="urlImage + item.thumbnail" alt="" srcset="">
            </div>
        </div>
        <h3>{{ item.title }}</h3>
    </router-link>
</template>
<script>
import { URL_IMAGE } from '../../../../Config'

export default {
    data() {
        return {
            urlImage: URL_IMAGE
        }
    },
    props: ['item']
}
</script>