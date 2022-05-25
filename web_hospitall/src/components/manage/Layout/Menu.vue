<template lang="vn">
    <div class="menu">
        <p class="title">MH HOSPITALL</p>
        <div class="imguser">
            <div class="infor"><img src="@/assets/img/user.png" alt="123"></div>
            <div>
                <span>{{admin.name}}</span><br>
                <span>Người quản trị</span>
            </div>
        </div>
    </div>
</template>
<script>
import {mapState} from "vuex"
export default {
    data(){
        return{}
    },
    computed:{
        ...mapState(['admin'])
    }
}
</script>
<style scoped>
.menu{
    width: 100%;
    height: 100%;
    padding:10px 20px;
}
.title{
    font-size: 24px;
    color: #776faf;
}
.infor{
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    object-fit: cover;
}
</style>