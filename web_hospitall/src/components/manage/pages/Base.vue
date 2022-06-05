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
                            <ul>
                                <li v-if="this.$route.name !== 'booklists'" @click="openModal()" class="orange">Thêm
                                </li>
                            </ul>
                            <input type="text" placeholder="Type" @input="onInput($event)">
                        </div>
                        <br />
                        <slot></slot>
                    </div>
                </div>
                <div v-else class="admin__content">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../Layout/Header.vue";
import Menu from '../Layout/Menu.vue';
import Request from '@/Request';
import { mapState, mapMutations } from 'vuex';
import { ref, provide } from "vue";
export default {
    props: ['onInput'],
    components: { Header, Menu },
    setup() {
        let state = ref(true)
        provide('btn_menu', state)
        return { state };
    },
    computed: {
        ...mapState(['admin', 'modal']),
    },
    methods: {
        ...mapMutations(['setadmin', 'setModal']),
        openModal: function () {
            this.setModal({ ...this.modal, data: true })
        },
        CheckAuth: function () {
            if (window.localStorage.getItem("K-admin")) {
                Request.GetAuth('/admin-information', 'K-admin')
                    .then((res) => {
                        this.setadmin(res.data)
                    })
                    .catch((err) => {
                        window.localStorage.removeItem('K-admin')
                        console.log(err)
                        this.$router.push({ name: 'admin_login' })
                    })
            }
            else {
                this.$router.push({ name: 'admin_login' })
            }
        },
    },
    mounted() {
        this.CheckAuth()
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