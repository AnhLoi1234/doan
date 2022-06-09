<template>
    <div class="reply__item">
        <div class="reply__item--top">
            <a href="">{{ item.fullname }}</a>
            <span class="bx bxs-check-circle"></span>
            <span>Đã khám</span>
        </div>
        <p class="reply__item--content">
            {{ item.content_reply }}
        </p>
    </div>
    <hr>
</template>
<script>
export default {
    props: ['item']
}
</script>