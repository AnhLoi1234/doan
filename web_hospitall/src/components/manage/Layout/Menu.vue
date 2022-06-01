<template lang="vn">
     <div class="admin">
        <div class="admin__container">
            <div class="admin__sidebar active" ref="menu">
                <p>Dashboard</p>
                <ul>
                    <li class="active">
                        <a href="">
                            <span class="bx bx-home"></span>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="bx bx-user"></span>
                            <span>{{menu}}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div @click="click" class="admin__content"></div>
        </div>
    </div>
</template>
<script>
import {mapState} from "vuex"
import { inject } from 'vue'
export default {
    setup(){
        const menu = inject('btn_menu');
        return menu;
    },
    computed:{
        ...mapState(['admin']),
    },
    mounted(){
        
    },
    methods:{
        click:function(){
            console.log(this.menu)
        }
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