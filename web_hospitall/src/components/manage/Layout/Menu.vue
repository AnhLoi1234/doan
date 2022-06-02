<template lang="vn">
     <div class="admin">
        <div class="admin__container">
            <div class="admin__sidebar" :class ="{'active':menu}">
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
                            <span></span>
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
        let menu = inject('btn_menu');
        return {menu};
    },
    computed:{
        ...mapState(['admin']),
    },
    mounted(){
        // this.menu = this.$refs.slide_menu
    },
    methods:{
        click:function(){
            console.log(this.$refs.btn_menu)
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