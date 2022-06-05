<template>
    <Base :onInput="onInput">
    <Table :heading="['Ảnh thu nhỏ', 'Tiêu đề', 'Lượt xem']" title="Danh sách bài viết" :loading="loading" :list="list">
        <tr v-for="(item, index) in list" :key="item.id">
            <td>{{ index + 1 }}</td>
            <td>
                <img :src="`${urlImage + item.thumbnail}`" style="width: 14rem; height:7rem;" alt="" srcset="">
            </td>
            <td>
                {{ item.title }}
            </td>
            <td>
                {{ item.view }}
            </td>
            <td>
                <span @click="editItem(item.id)" class="bx bx-pencil"></span>
            </td>
            <td>
                <span @click="deleteItem(item.id)"
                    :class="`bx bx-${loadingColumn === item.id ? 'loader loading' : 'trash'}`"></span>
            </td>
        </tr>
    </Table>
    <ModalBlog v-if="modal.data" :id="id" :setList="setList" :reset="reset">
    </ModalBlog>
    </Base>
</template>
<script>
import Base from "./Base.vue";
import Table from "../Table.vue";
import ModalBlog from "../modal/ModalBlog.vue";
import { mapMutations, mapState } from "vuex";
import Request from "../../../Request";
import { URL_IMAGE } from "../../../Config";
export default {
    components: {
        Base,
        Table,
        ModalBlog
    },
    computed: {
        ...mapState(['modal'])
    },
    methods: {
        ...mapMutations(['setModal']),
        onInput: function (event) {
            this.loading = true;
            this.counter += 1;
            clearTimeout(this.timeOut);
            this.timeOut = setTimeout(async () => {
                try {
                    const result = await Request.Post(`/blog-search`, {
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
                this.list = [...this.list, item];
            }
            else {
                let clone = [...this.list];
                clone[index] = item;
                this.list = clone;
            }
        },
        editItem: function (id) {
            //
            this.id = id;
            this.setModal({ ...this.modal, data: true });
        },
        deleteItem: async function (id) {
            try {
                this.loadingColumn = id;
                const result = await Request.Delete(`/blogs/${id}`);
                if (result.data.status) {
                    this.list = [...this.list].filter(dt => dt.id !== id);
                }
                this.loadingColumn = -1;
            } catch (error) {
                alert(error);
            }
        },
        reset: function () {
            this.id = null;
            this.data = null;
        }
    },
    data() {
        return {
            loading: true,
            id: null,
            list: [],
            urlImage: URL_IMAGE,
            loadingColumn: -1,
            timeOut: null,
            counter: 0
        }
    },
    mounted() {
        (async () => {
            try {
                //
                const result = await Request.Get('/blogs');
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error)
            }
        })();
    }
}
</script>