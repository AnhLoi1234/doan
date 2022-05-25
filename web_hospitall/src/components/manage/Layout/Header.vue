<template>
    <div class="header">
        <div class="icon" ref="BtnSidebar">
            <i class="fas fa-bars fa-2x" ></i>
        </div>
        <div class="search">
            <input type="text" placeholder="Tìm kiếm">
            <i class="fas fa-search fa-2x" ></i>
        </div>
        <div class="notificatin">
            <i class="fas fa-bell fa-2x"></i>
            <span>Thông Báo</span>
        </div>
        <div class="user">
            <i class="fas fa-user fa-2x"></i>
            <span>{{admin.name}}</span>
        </div>
    </div>
</template>
<script>
import {mapState} from 'vuex'
export default {
    data(){
        return {
        }
    },
    computed:{
        ...mapState(['admin']),
    },
    mounted() {
        console.log(this.$store.state.admin);
    },
    // methods:{
    //     click:function(){
    //         console.log(this.admin);
    //     }
    // }
}
</script>
<style scoped src = '@/assets/style/manage/components/layout/header.css'></style>