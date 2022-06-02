<template>
    <a href="" class="item__post--item">
        <div class="item__post--item--image img-wrap" :style="{ background: `url('${item.thumbnail}')` }">
        </div>
        <p class="item__post--item--text">
            {{ item ? item.namespecical : '...' }}
        </p>
    </a>
</template>
<script>
export default {
    props: ['item']
}
</script>