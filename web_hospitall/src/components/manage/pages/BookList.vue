<template>
    <Base :onInput="onInput" :optional="[
        { id: 'all', name: 'Tất cả', color: 'black', value: null },
        { id: 1, name: 'Đã huỷ', color: 'gray', value: -1 },
        { id: 2, name: 'Chưa duyệt', color: 'red', value: 0 },
        { id: 3, name: 'Đã duyệt', color: 'green', value: 1 },
        { id: 4, name: 'Đã khám', color: 'var(--color-bold)', value: 2 },
        { id: 5, name: 'Đã phản hồi', color: 'orange', value: 3 },
    ]" :handleOptional="(item) => { this.optionalActive = item }" :optionalActive="optionalActive">
    <Table :hideCrud="true" :title="'Danh sách lịch đặt khám'" :heading="['Tên khách hàng', 'Số điện thoại', 'Email', 'Tên bác sĩ', 'Giờ khám',
    'Ngày khám', 'Thời gian đặt', 'Tình trạng', 'Sửa']" :list="list" :loading="loading">
        <tr v-for="(item, index) in (
            optionalActive.id === 'all' ? list : list.filter(dt => dt.status_book_list == optionalActive.value)
        )" :key="item.id">
            <td>{{ index + 1 }}</td>
            <td>
                {{ item.fullname_main }}
            </td>
            <td>
                {{ item.phone_main }}
            </td>
            <td>
                {{ item.email_main }}
            </td>
            <td>
                {{ item.name_doctor }}
            </td>
            <td>
                {{ item.time }}
            </td>
            <td>
                {{ item.name + "/" + item.year }}
            </td>
            <td>
                {{ item.created_at_main }}
            </td>
            <td>
                <ItemStatus :statusMain="item.status_book_list" :isAdmin="true"></ItemStatus>
            </td>
            <td>
                <span @click="editItem(item.idbooklist_main, item.status_book_list)" class="bx bx-pencil"
                    :class="item.status_book_list === -1 || item.status_book_list === 2 || item.status_book_list === 3 ? 'disabled' : ''"></span>
            </td>
        </tr>
    </Table>
    <ModalOptionData v-if="modal.data" :list="[{ id: -1, name: 'Huỷ lịch', status: -1, hide: status == -1 || status == 1 },
    { id: 1, name: 'Duyệt lịch', status: 1, hide: status == 1 },
    { id: 2, name: 'Đã khám', status: 2, hide: status == 0 }]" table="booklist" :setList="setList"
        name="booklist-status" title="Lịch đặt khám" :id="id" :status="status">
    </ModalOptionData>
    </Base>
</template>
<script>
import Base from "./Base.vue";
import Table from "../Table.vue";
import ItemStatus from '../../user/components/ItemComponent/ItemStatus.vue';
import Request from "../../../Request";
import ModalOptionData from "../modal/ModalOptionData.vue";
import { mapMutations, mapState } from "vuex";
export default {
    components: {
        Base,
        Table,
        ItemStatus,
        ModalOptionData
    },
    computed: {
        ...mapState(['modal', 'admin'])
    },
    methods: {
        ...mapMutations(['setModal']),
        onInput: function (event) {
            this.value = event.target.value;
            this.loading = true;
            this.counter += 1;
            clearTimeout(this.timeOut);
            this.timeOut = setTimeout(async () => {
                try {
                    const result = await Request.Post(`/booklist-search`, {
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
            if (status !== -1 && status !== 2 && status !== 3) {
                this.status = status;
                this.setModal({ ...this.modal, data: true })
            }
        },
        setList: function (item) {
            const index = [...this.list].findIndex(dt => Number(dt.idbooklist_main) === Number(item.idbooklist_main));
            if (index !== -1) {
                let clone = [...this.list];
                clone[index] = item;
                this.list = clone;
            }
            else {
                this.list = [...this.list, item];
            }
        },
        fetchData: async function () {
            try {
                const result = await Request.Get(`/booklist-doctor/${this.admin?.id}`);
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error);
            }
        }
    },
    data() {
        return {
            value: '',
            id: null,
            status: -2,
            list: [],
            loading: true,
            counter: 0,
            timeOut: null,
            optionalActive: { id: 'all', value: null }
        }
    },
    watch: {
        admin: function (newData) {
            if (newData) {
                this.fetchData();
            }
        },
        optionalActive: async function () {
            try {
                this.loading = true;
                const result = await Request.Post(`/booklist-search`, {
                    value: this.value,
                    status: this.optionalActive.value
                });
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error);
            }
        }
    }
}
</script>