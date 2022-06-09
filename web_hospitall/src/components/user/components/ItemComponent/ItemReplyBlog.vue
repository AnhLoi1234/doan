<template>
    <div class="reply__item">
        <div class="reply__item--top">
            <a href="">{{ item.fullname }}</a>
            <!-- <span class="bx bxs-check-circle"></span>
            <span>Đã khám ngày 06/04/2022</span> -->
        </div>
        <p class="reply__item--content">
            {{ item.content_comment }}
        </p>
    </div>
    <hr>
</template>
<script>
export default {
    props: ['item']
}
</script>