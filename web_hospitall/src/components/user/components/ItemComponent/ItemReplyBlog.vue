<template>
    <div class="reply__item">
        <div class="reply__item--top">
            <a href="">{{ item.fullname }}</a>
            <span> {{ moment(item.created_at).format('hh:mm:ss DD/MM/Y') }}</span>
        </div>
        <p class="reply__item--content">
            {{ item.content_comment }}
        </p>
    </div>
    <hr>
</template>
<script>
import moment from 'moment'

export default {
    props: ['item'],
    data() {
        return {
            moment: moment
        }
    }
}
</script>