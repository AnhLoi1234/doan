<template>
    <Base>
    <div class="dashboard">
        <div class="dashboard__top">
            <ItemDashboard :name="'Người dùng'" route="users" icon="bx bx-user" :length="dashboard.user?.length">
            </ItemDashboard>
            <ItemDashboard :name="'Lịch đặt'" route="booklists" icon="bx bx-book-open"
                :length="dashboard.bookList?.length">
            </ItemDashboard>
            <ItemDashboard :name="'Bài viết'" route="blogs" icon="bx bx-pencil" :length="dashboard.blog?.length">
            </ItemDashboard>
            <ItemDashboard :name="'Liên hệ'" route="chats" icon="bx bxs-contact" :length="dashboard.groupChat?.length">
            </ItemDashboard>
        </div>
        <div class="dashboard__content flex main">
            <div class="dashboard__content--left dashboard__content--layout">
                <div class="flex-justify-between">
                    <p class="profile__title">Người dùng mới nhất</p>
                    <span @click="handleRouterLink('users')">Xem chi tiết</span>
                </div>
                <ul v-if="users">
                    <li v-for="item in users" :key="item.id">
                        <img :src="urlImage + item.avatar" alt="">
                        <div>
                            <p>{{ item.fullname }}</p>
                            <p>{{ moment(item.created_at).fromNow() }}</p>
                        </div>
                    </li>
                </ul>
                <div v-else class="loading__content">
                    <span class="bx bx-loader loading"></span>
                </div>
            </div>
            <div class="dashboard__content--right dashboard__content--layout">
                <div class="flex-justify-between">
                    <p class="profile__title">Lịch đặt mới nhất</p>
                    <span @click="handleRouterLink('booklists')">Xem chi tiết</span>
                </div>
                <ul v-if="bookLists">
                    <li v-for="item in bookLists" :key="item.id">
                        <img :src="urlImage + item.avatar_user" alt="">
                        <div>
                            <p>Bệnh nhân : {{ item.fullname }} - Bác sĩ : {{ item.name_doctor }}</p>
                            <p>{{ moment(item.created_at_main).fromNow() }}
                                - Thời gian khám :
                                {{ item.time }} - {{ item.dayofweek === 0 ? "Chủ nhật" : `Thứ
                                                                ${item.dayofweek + 1}`
                                }} - {{ item.day }}/{{ item.month }}
                            </p>
                        </div>
                        <box>
                            <ItemStatus :statusMain="item.status_book_list" :isAdmin="true" />
                        </box>
                    </li>
                </ul>
                <div v-else class="loading__content">
                    <span class="bx bx-loader loading"></span>
                </div>
            </div>
        </div>
    </div>
    </Base>
</template>
<script>
import Base from './pages/Base.vue';
import ItemDashboard from './ItemComponent/ItemDashboard.vue';
import Request from '../../Request';
import { URL_IMAGE } from '../../Config';
import ItemStatus from '../user/components/ItemComponent/ItemStatus.vue';
import moment from 'moment';
moment.locale("VI");
export default {
    components: { Base, ItemDashboard, ItemStatus },
    data() {
        return {
            urlImage: URL_IMAGE,
            moment: moment,
            dashboard: {
                user: null,
                blog: null,
                bookList: null,
                groupChat: null,
            },
            bookLists: null,
            users: null
        }
    },
    methods: {
        handleRouterLink: function (name) {
            this.$router.push({ name: name })
        }
    },
    mounted() {
        (async () => {
            try {
                let result = await Request.Get("/dashboard");
                this.dashboard.user = result.data.user.original.data;
                this.dashboard.blog = result.data.blog.original.data;
                this.dashboard.bookList = result.data.bookList.original.data;
                this.dashboard.groupChat = result.data.groupChat.original.data;
                result = await Request.Get("/user-limit");
                this.users = result.data.data;
                result = await Request.Get("/booklist-limit");
                this.bookLists = result.data.data;
            } catch (error) {
                alert(error);
            }
        })();
    }
}
</script>
