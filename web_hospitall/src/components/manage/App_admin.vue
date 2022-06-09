<template>
    <Base>
    <div class="dashboard">
        <div class="dashboard__top">
            <ItemDashboard :name="'Khách hàng'" :length="dashboard.user?.length"></ItemDashboard>
            <ItemDashboard :name="'Lịch đặt'" :length="dashboard.bookList?.length"></ItemDashboard>
            <ItemDashboard :name="'Bài viết'" :length="dashboard.blog?.length"></ItemDashboard>
            <ItemDashboard :name="'Liên hệ'" :length="dashboard.groupChat?.length"></ItemDashboard>
        </div>
        <div class="dashboard__content">
            <p>Khách hàng đặt lịch gần đây</p>
            <table>
                <tr>
                    <th>STT</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Tên bác sĩ</th>
                    <th>Thời gian khám</th>
                    <th>Thời gian đặt</th>
                </tr>
                <tr v-for="(item, index) in bookListNew" :key="item.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.fullname }}</td>
                    <td>{{ item.phone }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.item }} Thứ 2 31/5</td>
                    <td>{{ item.created_at }}</td>
                </tr>
            </table>
        </div>
    </div>
    </Base>
</template>
<script>
import Base from './pages/Base.vue';
import ItemDashboard from './ItemComponent/ItemDashboard.vue';
import Request from '../../Request';
export default {
    components: { Base, ItemDashboard },
    data() {
        return {
            dashboard: {
                user: null,
                blog: null,
                bookList: null,
                groupChat: null,
                bookListNew: [],
            }
        }
    },
    mounted() {
        (async () => {
            try {
                const result = await Request.Get("/dashboard");
                const bookLists = await Request.Get("/booklist-limit");
                this.bookListNew = bookLists.data.data;
                this.dashboard.user = result.data.user.original.data;
                this.dashboard.blog = result.data.blog.original.data;
                this.dashboard.bookList = result.data.bookList.original.data;
                this.dashboard.groupChat = result.data.groupChat.original.data;
            } catch (error) {
                alert(error);
            }
        })();
    }
}
</script>
