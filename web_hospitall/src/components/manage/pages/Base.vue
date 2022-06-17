<template>
    <div class="" style="display: flex;flex-direction: column;height: 100vh;overflow: hidden;">
        <Header></Header>
        <div class="admin" style="flex:1;">
            <div class="admin__container">
                <Menu></Menu>
                <div v-if="this.$route.name !== 'chats'" class="admin__content">
                    <div class="admin_value">
                        <br />
                        <div v-if="this.$route.name !== 'manage' && this.$route.name !== 'chats'"
                            class="admin_value__top">
                            <div v-if="optional" class="flex">
                                <span v-for="item in optional" :key="item.id" @click="handleOptional(item)"
                                    class="status" :class="optionalActive.id === item.id ? 'active' : ''"
                                    :style="{ background: item.color }">
                                    {{ item.name }}
                                </span>
                            </div>
                            <ul>
                                <li v-if="this.$route.name !== 'booklists' && this.$route.name !== 'users'"
                                    @click="openModal()" class="orange">Thêm
                                </li>
                            </ul>
                            <input type="text" placeholder="Tìm kiếm thông tin" @input="onInput($event)">
                        </div>
                        <br />
                        <slot></slot>
                    </div>
                </div>
                <div v-else class="admin__content">
                    <slot v-if="!loading"></slot>
                </div>
            </div>
        </div>
    </div>
    <ModalRequestJoin v-if="modalShow" :handleAccept="handleAccept" :handleDeny="handleDeny" :data="data">
    </ModalRequestJoin>
</template>

<script>
import Header from "../Layout/Header.vue";
import Menu from '../Layout/Menu.vue';
import Request from '@/Request';
import { mapState, mapMutations } from 'vuex';
import { ref, provide } from "vue";
import ModalRequestJoin from "../modal/ModalRequestJoin.vue";
import Admin_Router from "../../../Router/Router_admin";
import { v4 } from 'uuid';

export default {
    props: ['onInput', 'optional', 'handleOptional', 'optionalActive'],
    components: { Header, Menu, ModalRequestJoin },
    setup() {
        let state = ref(true)
        provide('btn_menu', state)
        return { state };
    },
    data() {
        return {
            loading: true,
            modalShow: false,
            data: null,
            v4: v4
        }
    },
    computed: {
        ...mapState(['admin', 'modal', 'socket']),
    },
    methods: {
        ...mapMutations(['setadmin', 'setModal', 'setKeyChat']),
        openModal: function () {
            this.setModal({ ...this.modal, data: true })
        },
        CheckAuth: function () {
            if (window.localStorage.getItem("K-admin")) {
                Request.GetAuth('/admin-information', 'K-admin')
                    .then((res) => {
                        this.setadmin(res.data);
                        if (res.data) {
                            const index = Admin_Router.findIndex(dt => (dt.role === 'all' || dt.role == res.data.role) && this.$route.name === dt.name);
                            if (index === -1) {
                                alert('Không được phép truy cập')
                                this.$router.push({ name: 'manage' })
                            }
                            this.loading = false;
                        }
                    })
                    .catch(() => {
                        window.localStorage.removeItem('K-admin');
                        this.$router.push({ name: 'admin_login' })
                    })
            }
            else {
                this.$router.push({ name: 'admin_login' })
            }
        },
        handleAccept: function (data) {
            this.setKeyChat(this.v4())
            this.socket.emit('acceptJoin', { ... this.data, typeAccess: 2, groupChat: data });
            this.$router.push({ name: 'chats' });
            this.modalShow = false;
        },
        handleDeny: function () {
            this.setKeyChat(this.v4())
            this.socket.emit('acceptJoin', { ... this.data, typeAccess: 3 });
            this.modalShow = false;
        }
    },
    watch: {
        admin: function (newData) {
            this.socket.on(`_requestJoin.${newData?.id}`, (data) => {
                this.modalShow = true;
                this.data = data;
            })
            setInterval(async () => {
                await Request.Put('/update-online', {
                    id: this.admin?.id
                });
            }, 30000);
        },
    },
    mounted() {
        this.CheckAuth();
    },
}
</script>
<style scoped>
#app {
    font-family: 'Montserrat', sans - serif;
    font-family: 'Roboto Condensed', sans - serif;
}

.container {
    display: flex;
}

.Menu {
    width: 20%;
}

.content {
    width: 100%;
}
</style >