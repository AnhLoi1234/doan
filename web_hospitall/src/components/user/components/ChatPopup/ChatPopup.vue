<template>
    <div class="button-chat-popup">
        <div>
            <span @click="isShow = !isShow" class="bx bx-chat"></span>
            <ChatPopupContainer :isShow="isShow" :setIsShow="setIsShow" />
        </div>
    </div>
</template>
<script>
import ChatPopupContainer from './ChatPopupContainer.vue';
export default {
    components: { ChatPopupContainer },
    methods: {
        setIsShow: function (isShow) {
            this.isShow = isShow;
        }
    },
    data() {
        return {
            isShow: false
        }
    }
}
</script>