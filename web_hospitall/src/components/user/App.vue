<template>
    <div id="main">
        <Header></Header>
        <Content></Content>
        <Footer></Footer>
        <Loading v-if="User_load"></Loading>
    </div>
</template>

<style scoped src = '@/assets/style/user/app.css'>
</style>

<script>
import Header from './components/layout/Header.vue'
import Content from './components/layout/Content.vue'
import Footer from './components/layout/Footer.vue'
import Loading from './Loading.vue'
import Request  from '@/Request'
import { mapState, mapMutations} from 'vuex'
export default {
    components: {
        Header,
        Footer,
        Content,
        Loading
    },
    computed:{
        ...mapState(['User_load'])
    },
    methods: {
        ...mapMutations(['setuser'])
    },
    beforeCreate(){
        if(window.localStorage.getItem('k-user')){
        Request.Post('/user-information',)
        .then((res) =>{
            // this.setuser(re)
            console.log(res);
        })
        }

    }
}
</script>