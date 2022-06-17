<template>
    <Base>
    <div v-if="!loading" class="chat">
        <div class="chat__left">
            <div class="chat__left--search">
                <input type="text" placeholder="Search">
                <span class="bx bx-search"></span>
            </div>
            <div class="chat__left--content">
                <div v-for="(item, index) in groupChats" :key="item.id">
                    <div @click="handleItemChat(item, index)" class="chat__item"
                        :class="groupChat.id === item.groupChat.id ? 'active' : ''">
                        <div class="chat__item--image">
                            <img :src="urlImage" alt="" srcset="">
                            <span></span>
                        </div>
                        <div class="chat__item--content">
                            <p>{{ item.groupChat.fullname }}</p>
                            <p>{{ item.message?.content_chat || ':)' }}</p>
                        </div>
                        <div class="chat__item--time">
                            <p></p>
                            <!-- <p>{{ moment(item.message?.created_at).fromNow() }}</p> -->
                            <p v-if="item.lengthIsRead != 0">{{ item.lengthIsRead }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat__right">
            <div class="chat__right--top">
                <span style="cursor: pointer;">Xoa tat ca</span>
            </div>
            <ChatPopupContent v-if="!loadingMessage" :messages="messages" :id="groupChat?.groupChat?.user"
                :groupChat="groupChat.groupChat" :_id="admin?.id" :setMessage="setMessage" :sendMessage="sendMessage" />
            <div v-else class="loading__content">
                <span class="bx bx-loader loading"></span>
            </div>
        </div>
    </div>
    <div v-else class="loading__content">
        <span class="bx bx-loader loading"></span>
    </div>
    </Base>
</template>
<script>
import Base from "./Base.vue";
import ChatPopupContent from "../../ChatPopupContent.vue";
import Request from "../../../Request";
import { mapState } from "vuex";
import { URL_IMAGE } from "../../../Config";
import moment from "moment";

export default {
    components: {
        Base,
        ChatPopupContent
    },
    computed: {
        ...mapState(['admin', 'socket', 'keyChat'])
    },
    methods: {
        handleItemChat: function (groupChat, index) {
            this.groupChat = groupChat;
            let clone = [...this.groupChats];
            clone[index].lengthIsRead = 0;
            this.groupChats = clone;
        },
        setMessage: function (message) {
            this.messages = [...this.messages, message];
        },
        sendMessage: async function (message) {
            try {
                const result = await Request.Post('/chats', {
                    idgroupchat: this.groupChat?.groupChat?.id,
                    content_chat: message.content_chat,
                    is_user: this.admin?.id,
                    idadmin: this.admin?.id,
                    type_chat: 1,
                });
                result.data.data._id = this.groupChat?.groupChat?.user;
                this.socket.emit('chatMessage', result.data.data);
                this.messages = [...this.messages, result.data.data];
            } catch (error) {
                console.log(error);
            }
        }
    },
    data() {
        return {
            loading: true,
            id: null,
            groupChats: [],
            groupChat: { id: null },
            urlImage: URL_IMAGE + 'user-vector.jpeg',
            messages: [],
            loadingMessage: false,
            moment: moment
        }
    },
    watch: {
        admin: async function (newData) {
            try {
                const result = await Request.Get(`/groupChats/${newData?.id}`);
                this.groupChats = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error);
            }
        },
        keyChat: async function () {
            try {
                const result = await Request.Get(`/groupChats/${this.admin?.id}`);
                this.groupChats = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error);
            }
        },
        groupChat: async function () {
            try {
                this.loadingMessage = true;
                const result = await Request.Get(`/chats/${this.groupChat.groupChat.id}`);
                this.messages = result.data.data;
                this.loadingMessage = false;
            } catch (error) {
                alert(error);
            }
        }
    }
}
</script>