<template>
    <Base>
    <Table :loading="loading" :title="'Danh sáchh bác sĩ'" :list="list" :length="'8'"
        :heading="['Ảnh đại diện', 'Số điện thoại ', 'Chuyên khoa', 'Họ tên', 'Tên đăng nhập']">
        <tr v-for="(item, key) in list" :key="item.id">
            <td>{{ key + 1 }}</td>
            <td><img :src="item.avatar" style="border-radius:100rem;width: 10rem;height:10rem;object-fit: cover;" alt=""
                    srcset="">
            </td>
            <td>{{ item.sdt }}</td>
            <td>{{ item.namespecical }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.username }}</td>
            <td>
                <span class="bx bx-pencil"></span>
            </td>
            <td>
                <span class="bx bx-trash"></span>
            </td>
        </tr>
    </Table>
    <div v-if="modal.data">
        <ModalDoctor></ModalDoctor>
    </div>
    </Base>

</template>
<script>
import Base from "./Base.vue";
import Table from "../Table.vue";
import Request from "../../../Request";
import ModalDoctor from "../modal/ModalDoctor.vue";
import { mapState } from "vuex";
export default {
    data() {
        return {
            list: [],
            loading: true
        }
    },
    computed: {
        ...mapState(['modal'])
    },
    components: {
        Base,
        Table,
        ModalDoctor
    },
    mounted() {
        (async () => {
            try {
                const result = await Request.Get('/doctor-admin');
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error)
            }
        })();
    }
}
</script>