<template>
    <div class="chat__right--content--content" ref="containerMessage">
        <div v-if="messages?.length">
            <div v-for="message in messages" :key="message.id">
                <div v-if="message.is_user == id" class="message__item flex-start">
                    <div class="message__item--image">
                        <img :src="urlImage + (message.is_user == id ? 'user-vector.jpeg' : 'doctor-vector.webp')"
                            alt="">
                        <span></span>
                    </div>
                    <div class="message__item--content">
                        <p>{{ message.content_chat }}</p>
                        <span>
                            {{ moment(message.created_at_main).fromNow() }}
                        </span>
                    </div>
                </div>
                <div v-else class="message__item flex-end">
                    <div class="message__item--content">
                        <p>{{ message.content_chat }}</p>
                        <span>
                            {{ moment(message.created_at_main).fromNow() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="loading__content"
            style="text-align: center;padding:0rem 2rem;font-size: 1.3rem;font-weight: 600;">
            Bây giờ bạn có thể trò chuyện với bác sĩ
        </div>
    </div>
    <div class="chat__right--content--control">
        <input v-if="loading" type="text" placeholder="Search" :value="content" disabled>
        <input v-else type="text" @keydown="handleInputSendMessage($event)" @input="onInput($event)" :value="content"
            placeholder="Search">
        <span v-if="content.length !== 0" @click="handleSendMessage"
            :class="loading ? 'bx bx-loader loading' : 'bx bx-send'"></span>
        <span v-else class="bx bx-send disabled"></span>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import moment from 'moment';
import { URL_IMAGE } from '../Config';

moment.locale("VI");

export default {
    props: ['messages', 'sendMessage', 'idadmin', 'id', 'doctor', 'setMessage', 'groupChat', '_id'],
    data() {
        return {
            loading: false,
            content: '',
            moment: moment,
            urlImage: URL_IMAGE
        }
    },
    computed: {
        ...mapState(['socket'])
    },
    methods: {
        handleInputSendMessage: function (event) {
            if (event.keyCode === 13) {
                this.handleSendMessage();
            }
        },
        handleSendMessage: function () {
            if (this.content.length !== 0) {
                this.loading = true;
                this.sendMessage({ content_chat: this.content, idadmin: this.id });
                this.loading = false;
                this.content = '';
            }
        },
        onInput: function (event) {
            this.content = event.target.value
        },
        updateFormatTime: function (d) {
            const checkNumber = (number) => number < 10 ? `0${number}` : number;
            return checkNumber(d.getDate()) + "-" + checkNumber((d.getMonth() + 1)) + "-" + d.getFullYear() + " " +
                checkNumber(d.getHours()) + ":" + checkNumber(d.getMinutes())
        },
        socketOn: function () {
            try {
                this.socket.on(`_chatMessage.${this.groupChat?.id}.${this._id}`, (data) => {
                    console.log('nhan roi ne');
                    this.setMessage(data);
                })
            } catch (error) {
                alert(error);
            }
        }
    },
    watch: {
        groupChat: function () {
            this.socketOn();
        },
        _id: function () {
            this.socketOn();
        },
        messages: {
            handler() {
                if (this.$refs.containerMessage) {
                    console.log(this.$refs.containerMessage.scrollHeight);
                    this.$refs.containerMessage.scrollTop = this.$refs.containerMessage.scrollHeight;
                }
            },
            immediate: true
        }
    },
    mounted() {
        this.socketOn();
        if (this.$refs.containerMessage) {
            console.log(this.$refs.containerMessage.scrollHeight);
            this.$refs.containerMessage.scrollTop = this.$refs.containerMessage.scrollHeight;
        }
    }
}
</script>