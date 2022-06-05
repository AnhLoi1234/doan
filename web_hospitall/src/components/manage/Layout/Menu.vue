<template lang="vn">
<div class="admin__sidebar" :class="{ 'active': menu }">
    <!-- <p>Dashboard</p> -->
    <ul>
        <li v-for="route in routes" :key="route.id" :class="this.$route.name === (route.route) ? 'active' : ''">
          <router-link :to="{name: route.route}">
                <span :class="`bx bx-${route.icon}`"></span>
                <span>{{route.name}}</span>
           </router-link>
        </li>
    </ul>
</div>
</template>

<script>
import {
    mapState
} from "vuex"
import {
    inject
} from 'vue'
export default {
    data() {
        return {
            routes: [{ id: -1, name: 'Tổng quan', route: 'manage', icon: 'home' }, { id: 0, name: 'Người dùng', route: 'users', icon: 'user' },
            { id: 1, name: 'Bác sĩ', route: 'doctors', icon: 'user-circle' }, { id: 2, name: 'Chuyên khoa', route: 'specicallists', icon: 'spreadsheet' },
            { id: 3, name: 'Thời gian đặt', route: 'timebooks', icon: 'time' }, { id: 4, name: 'Bài viết', route: 'blogs', icon: 'pencil' },
            { id: 5, name: 'Lịch đặt khám', route: 'booklists', icon: 'calendar' }, { id: 6, name: 'Hỗ trợ', route: 'chats', icon: 'chat' }]
        }
    },
    setup() {
        let menu = inject('btn_menu');
        return {
            menu
        };
    },
    computed: {
        ...mapState(['admin']),
    },
    mounted() {
        // this.menu = this.$refs.slide_menu
    },
    methods: {
        click: function () {
            console.log(this.$refs.btn_menu)
        }
    }
}
</script>

<style scoped>
.menu {
    width: 100%;
    height: 100%;
    padding: 10px 20px;
}

.title {
    font-size: 24px;
    color: #776faf;
}

.infor {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    object-fit: cover;
}
</style>
