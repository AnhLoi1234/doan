<template>
    <Base :onInput="onInput">
    <Table :loading="loading" :title="'Danh sách thời gian đặt'" :heading="['Thời gian']" :list="list" :length="'4'">
        <tr v-for="(item, key) in list" :key="item.id">
            <td>{{ key + 1 }}</td>
            <td>{{ item.time }}</td>
            <td>
                <span @click="editItem(item.id)" class="bx bx-pencil"></span>
            </td>
            <td>
                <span @click="deleteItem(item.id)"
                    :class="`bx bx-${loadingColumn === item.id ? 'loader loading' : 'trash'}`"></span>
            </td>
        </tr>
    </Table>
    <ModalTimeBook v-if="this.modal.data" :id="id" :list="list" :setList="setList" :reset="reset"></ModalTimeBook>
    </Base>
</template>
<script>
import Base from "./Base.vue";
import Table from "../Table.vue";
import Request from "../../../Request";
import ModalTimeBook from "../modal/ModalTimeBook.vue";
import { mapMutations, mapState } from "vuex";
export default {
    components: {
        Base,
        Table,
        ModalTimeBook
    },
    computed: {
        ...mapState(['modal'])
    },
    data() {
        return {
            id: null,
            loading: true,
            list: [],
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
                    const result = await Request.Post(`/timebook-search`, {
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
            const index = [...this.list].findIndex(dt => dt.id === item.id);
            if (index === -1) {
                this.list = [...this.list, item]
            }
            else {
                let clone = [...this.list];
                clone[index] = item;
                this.list = clone;
            }
        },
        editItem: function (id) {
            this.id = id;
            this.setModal({ ...this.modal, data: true })
        },
        deleteItem: async function (id) {
            try {
                this.loadingColumn = id;
                const result = await Request.Delete(`/timebooks/${id}`);
                if (result.data.status) {
                    this.list = [...this.list].filter(dt => dt.id !== id);
                }
                this.loadingColumn = -1;
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        (async () => {
            try {
                const result = await Request.Get('/timebooks');
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error)
            }
        })()
    }
}
</script>