<template>
    <router-link :to="{ name: 'Doctors', params: { slug: item.slugspecical } }" class="item__post--item">
        <div class="item__post--item--image img-wrap" :style="{ background: `url('${urlImage + item.thumbnail}')` }">
        </div>
        <p class="item__post--item--text">
            {{ item ? item.namespecical : '...' }}
        </p>
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