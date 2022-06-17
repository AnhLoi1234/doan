<template>
    <div class='request-join'>
        <div class="request-join-top">
            <img src="https://images.unsplash.com/photo-1555952517-2e8e729e0b44?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80"
                alt="" />
            <div>
                <p>Có người dùng cần tư vấn?</p>
                <p>
                    {{ data?.fullname }} ({{ data?.phone }})
                </p>
            </div>
        </div>
        <div class="request-join-content">
            <p>
                <i class='bx bx-check-shield'></i>
                Bất kì yêu cầu tư vấn phải có sự cho phép của bạn mới có thể trò chuyện với bạn.
            </p>
            <ul class='flex-1 text-sm pl-10 pr-5'>
                <li @click="handleDeny">Từ chối</li>
                <li @click="accept" :class="loading ? 'bx bx-loader loading' : ''">
                    {{ loading ? '' : 'Chấp nhận' }}
                </li>
            </ul>
        </div>
    </div>
    <div class="request-join-overlay"></div>
</template>
<script>
import { mapState } from 'vuex';
import Request from '../../../Request';

export default {
    props: ['handleAccept', 'data', 'handleDeny'],
    data() {
        return {
            loading: false
        }
    },
    computed: {
        ...mapState(['admin'])
    },
    methods: {
        accept: async function () {
            try {
                this.loading = true;
                const result = await Request.Post('/groupChats', {
                    fullname: this.data?.fullname,
                    phone: this.data?.phone,
                    user: this.data?.userS
                });
                await Request.Post('/chats', {
                    idgroupchat: result.data.data.id,
                    content_chat: 'demo',
                    is_user: result.data.data.user,
                    idadmin: this.admin.id,
                    type_chat: 0,
                });
                await Request.Post('/chats', {
                    idgroupchat: result.data.data.id,
                    content_chat: 'demo',
                    is_user: this.admin.id,
                    idadmin: this.admin.id,
                    type_chat: 0,
                });
                this.handleAccept(result.data.data);
                this.loading = false;
            } catch (error) {
                alert(error);
            }
        }
    }
}
</script>