<template>
    <Base :onInput="onInput">
    <Table :loading="loading" :title="'Danh sáchh bác sĩ'" :list="list" :length="'8'"
        :heading="['Ảnh đại diện', 'Số điện thoại ', 'Chuyên khoa', 'Họ tên', 'Tên đăng nhập']">
        <tr v-for="(item, key) in list" :key="item.id">
            <td>{{ key + 1 }}</td>
            <td><img :src="urlImage + item.avatar"
                    style="border-radius:100rem;width: 10rem;height:10rem;object-fit: cover;" alt="" srcset="">
            </td>
            <td>{{ item.sdt }}</td>
            <td>{{ item.namespecical }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.username }}</td>
            <td>
                <span @click="editItem(item.idadmin)" class="bx bx-pencil"></span>
            </td>
            <td>
                <span @click="deleteItem(item.idadmin)"
                    :class="`bx bx-${loadingColumn === item.id ? 'loader loading' : 'trash'}`"></span>
            </td>
        </tr>
    </Table>
    <ModalDoctor v-if="modal.data" :reset="reset" :id="id" :setList="setList" :list="list"></ModalDoctor>
    </Base>

</template>
<script>
import Base from "./Base.vue";
import Table from "../Table.vue";
import Request from "../../../Request";
import ModalDoctor from "../modal/ModalDoctor.vue";
import { mapMutations, mapState } from "vuex";
import { URL_IMAGE } from "../../../Config";
export default {
    data() {
        return {
            list: [],
            loading: true,
            id: null,
            urlImage: URL_IMAGE,
            loadingColumn: -1,
            timeOut: null,
            counter: 0
        }
    },
    methods: {
        ...mapMutations(['setModal']),
        reset: function () {
            this.id = null;
            this.data = null;
        },
        onInput: function (event) {
            this.loading = true;
            this.counter += 1;
            clearTimeout(this.timeOut);
            this.timeOut = setTimeout(async () => {
                try {
                    const result = await Request.Post(`/doctor-search`, {
                        value: event.target.value
                    });
                    this.list = result.data.data;
                    this.loading = false;
                } catch (error) {
                    alert(error);
                }
            }, 300);
        },
        setList: function (item) {
            const index = [...this.list].findIndex(dt => dt.idadmin === item.idadmin);
            if (index === -1) {
                this.list = [...this.list, item];
            }
            else {
                let clone = [...this.list];
                clone[index] = item;
                this.list = clone;
            }
        },
        deleteItem: async function (id) {
            try {
                this.loadingColumn = id;
                const result = await Request.Delete(`/doctors/${id}`);
                if (result.data.status) {
                    this.list = [...this.list].filter(dt => dt.idadmin !== id);
                }
                this.loadingColumn = -1;
            } catch (error) {
                alert(error);
            }
        },
        editItem: function (id) {
            this.id = id;
            this.setModal({ ...this.modal, data: true });
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