<template>
    <div class="chat-popup__form" :class="isShow ? 'active' : ''">
        <p class="chat-popup__form--title">
            {{ isLogin === 1 ? 'Hổ trợ trực tuyến' : isLogin === 2 ? doctor?.name : 'Nhập thông tin' }}
        </p>
        <div @click="handleClose" class="chat-popup__form--close bx bx-x"></div>
        <ChatPopupForm v-if="isLogin === 0" :isLogin="isLogin" :setIsLogin="setIsLogin" :setDoctor="setDoctor"
            :id="id" />
        <ChatPopupWating v-if="isLogin === 1" :setIsLogin="setIsLogin" :doctor="doctor" :id="id" :setData="setData" />
        <ChatPopupContent v-if="isLogin === 2" :setIsLogin="setIsLogin" :messages="messages" :sendMessage="sendMessage"
            :id="doctor?.idadmin" :doctor="doctor" :groupChat="data.groupChat" :_id="id" :setMessage="setMessage" />
        <ChatPopupDeny v-if="isLogin === 3" :setIsLogin="setIsLogin" />
    </div>
</template>
<script>
import ChatPopupForm from './ChatPopupForm.vue';
import ChatPopupContent from '../../../ChatPopupContent.vue';
import ChatPopupWating from './ChatPopupWating.vue';
import { v4 } from 'uuid';
import Request from '../../../../Request';
import { mapState } from 'vuex';
import ChatPopupDeny from './ChatPopupDeny.vue';
export default {
    props: ["isShow", "setIsShow"],
    data() {
        return {
            id: v4(),
            isLogin: 0,
            isSuccess: false,
            data: null,
            doctor: null,
            messages: []
        }
    },
    computed: {
        ...mapState(['socket'])
    },
    methods: {
        handleClose: function () {
            this.setIsShow(false);
        },
        setDoctor: function (doctor) {
            this.doctor = doctor;
        },
        setIsLogin: function (isLogin) {
            this.isLogin = isLogin;
        },
        setData: function (data) {
            this.data = data;
        },
        setMessage: function (message) {
            this.messages = [...this.messages, message];
        },
        sendMessage: async function (message) {
            try {
                const result = await Request.Post('/chats', {
                    idgroupchat: this.data?.groupChat?.id,
                    content_chat: message.content_chat,
                    is_user: this.data?.userS,
                    idadmin: this.doctor?.idadmin,
                    type_chat: 1,
                });
                result.data.data._id = this.doctor?.idadmin;
                this.socket.emit('chatMessage', result.data.data);
                this.messages = [...this.messages, result.data.data];
            } catch (error) {
                console.log(error);
            }
        }
    },
    components: { ChatPopupForm, ChatPopupContent, ChatPopupWating, ChatPopupDeny }
}
</script>