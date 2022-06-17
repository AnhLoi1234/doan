<template>
    <Base :onInput="onInput" :optional="[
        { id: 'all', name: 'Tất cả', color: 'black', value: null },
        { id: 1, name: 'Bình thường', color: 'green', value: 1 },
        { id: 2, name: 'Khoá', color: 'red', value: 0 }
    ]" :handleOptional="(item) => { this.optionalActive = item }" :optionalActive="optionalActive">
    <Table :heading="['Ảnh đại diện', 'Họ tên', 'Số điện thoại', 'Email', 'Tình trạng', 'Sửa']" :hideCrud="true"
        :title="'Danh sách người dùng'" :loading="loading" :list="list">
        <tr v-for="(item, index) in (
            optionalActive.id === 'all' ? list : list.filter(dt => dt.status === optionalActive.value)
        )" :key="item.id">
            <td>{{ index + 1 }}</td>
            <td>
                <img :src="`${urlImage + item.avatar}`"
                    style="width: 8rem; height:8rem;object-fit: cover;border-radius: 100rem;" alt="" srcset="">
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
            <td>
                <span :class="item.status === 1 ? 'green' : 'red'">
                    {{ item.status === 1 ? 'Bình thường' : 'Khoá' }}</span>
            </td>
            <td>
                <span @click="editItem(item.id, item.status)" class="bx bx-pencil"></span>
            </td>
        </tr>
    </Table>
    <ModalOptionData v-if="modal.data" title="Người dùng" name="status-user" :setList="setList" table="user" :id="id"
        :list="[{ id: 1, name: 'Khoá', status: 0 }, { id: 2, name: 'Bình thường', status: 1 }]" :status="status">
    </ModalOptionData>
    </Base>
</template>
<script>
import Base from "./Base.vue";
import Table from "../Table.vue";
import Request from "../../../Request";
import { URL_IMAGE } from "../../../Config";
import { mapMutations, mapState } from "vuex";
import ModalOptionData from '../modal/ModalOptionData.vue';
export default {
    components: {
        Base,
        Table,
        ModalOptionData
    },
    computed: {
        ...mapState(['modal'])
    },
    methods: {
        ...mapMutations(['setModal']),
        onInput: function (event) {
            this.loading = true;
            this.value = event.target.value;
            this.counter += 1;
            clearTimeout(this.timeOut);
            this.timeOut = setTimeout(async () => {
                try {
                    const result = await Request.Post(`/user-search`, {
                        value: event.target.value,
                        status: this.optionalActive.value
                    });
                    this.list = result.data.data;
                    this.loading = false;
                } catch (error) {
                    alert(error);
                }
            }, 300);
        },
        editItem: function (id, status) {
            this.id = id;
            this.status = status;
            this.setModal({ ...this.modal, data: true })
        },
        setList: function (item) {
            const index = [...this.list].findIndex(dt => dt.id === item.id);
            if (index !== -1) {
                let clone = [...this.list];
                clone[index] = item;
                this.list = clone;
            }
            else {
                this.list = [...this.list, item];
            }
        }
    },
    data() {
        return {
            value: 0,
            optionalActive: { id: 'all', value: null },
            status: -1,
            id: null,
            list: [],
            loading: true,
            urlImage: URL_IMAGE,
            timeOut: null,
            counter: 0
        }
    },
    watch: {
        optionalActive: async function () {
            try {
                this.loading = true;
                const result = await Request.Post(`/user-search`, {
                    value: this.value,
                    status: this.optionalActive.value
                });
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error);
            }
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