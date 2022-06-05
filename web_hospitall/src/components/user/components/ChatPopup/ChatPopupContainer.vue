<template>
    <div class="chat-popup__form" :class="isShow ? 'active' : ''">
        <p class="chat-popup__form--title">
            {{ isLogin ? 'Hổ trợ trực tuyến' : 'Nhập thông tin' }}
        </p>
        <div @click="handleClose" class="chat-popup__form--close bx bx-x"></div>
        <ChatPopupForm v-if="!isLogin" :setIsLogin="setIsLogin" />
        <ChatPopupContent v-else />
    </div>
</template>
<script>
import ChatPopupForm from './ChatPopupForm.vue';
import ChatPopupContent from '../../../ChatPopupContent.vue';
export default {
    props: ["isShow", "setIsShow"],
    data() {
        return {
            isLogin: false,
            isSuccess: false,
        }
    },
    methods: {
        handleClose: function () {
            this.setIsShow(false);
        },
        setIsLogin: function (isLogin) {
            this.isLogin = isLogin;
        }
    },
    components: { ChatPopupForm, ChatPopupContent }
}
</script>