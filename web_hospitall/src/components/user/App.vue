<template>
    <div id="main">
        <Header></Header>
        <Content></Content>
        <Footer></Footer>
        <ChatPopup />
        <Loading v-if="User_load"></Loading>
    </div>
</template>

<script>
import Header from './components/layout/Header.vue'
import Content from './components/layout/Content.vue'
import Footer from './components/layout/Footer.vue'
import Loading from './Loading.vue'
import Request from '@/Request'
import { mapState, mapMutations } from 'vuex'
import ChatPopup from './components/ChatPopup/ChatPopup.vue'
export default {
    components: {
        Header,
        Footer,
        Content,
        Loading,
        ChatPopup
    },
    computed: {
        ...mapState(['User_load'])
    },
    methods: {
        ...mapMutations(['setuser'])
    },
    beforeCreate() {
        if (window.localStorage.getItem('K-user')) {
            Request.GetAuth('/user-information', 'K-user')
                .then((res) => {
                    // this.setuser(re)
                    this.setuser(res.data)
                })
        }
    },

}
</script>

<style src="@/assets/style/main.css">
</style>