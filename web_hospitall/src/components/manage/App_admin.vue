<template>
    <div class="">
        <Header></Header>
        <Menu></Menu>
    </div>
</template>

<script>
import Header from './Layout/Header.vue'
import Menu from './Layout/Menu.vue'
import Request from '@/Request';
import { mapState, mapMutations } from 'vuex';
import { ref, provide } from "vue";
export default{
    setup(){
        let state = ref(123123)

        provide('btn_menu',state)
        return state;
    },
    computed: {
        ...mapState(['admin']),
    },
    methods: {
        ...mapMutations(['setadmin']),
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
        console.log(this.state)
    },
    components: {
        Header,
        Menu
    }
}
</script>
<style scoped>
#app {
    font-family: 'Montserrat', sans-serif;
    font-family: 'Roboto Condensed', sans-serif;
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
</style>