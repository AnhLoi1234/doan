<template>
    <Base>
    <Table :heading="['Ảnh đại diện', 'Họ tên', 'Số điện thoại', 'Email']" hideCrud="true"
        :title="'Danh sách người dùng'" :loading="loading" :list="list">
        <tr v-for="(item, index) in list" :key="item.id">
            <td>{{ index + 1 }}</td>
            <td>
                <!-- <img :src="`${urlImage + item.thumbnail}`" style="width: 14rem; height:7rem;" alt="" srcset=""> -->
            </td>
            <td>
                {{ item.fullname }}
            </td>
            <td>
                {{ item.phone }}
            </td>
            <td>
                {{ item.email }}
            </td>
        </tr>
    </Table>
    </Base>
</template>
<script>
import Base from "./Base.vue";
import Table from "../Table.vue";
import Request from "../../../Request";
export default {
    components: {
        Base,
        Table
    },
    data() {
        return {
            list: [],
            loading: true
        }
    },
    mounted() {
        (async () => {
            try {
                this.loading = true;
                const result = await Request.Get('/users');
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error)
            }
        })();
    }
}
</script>