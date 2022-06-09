<template>
    <ModalAdmin :title="title" nameButton="Cập nhật tình trạng" :onSubmit="onSubmit">

        <div v-for="item in list" :key="item.id">
            <div class="radio-option" v-if="!item.hide">
                <input v-model="statusUpdate" @change="onChange($event)" type="radio" :name="name"
                    :value="`${item.status}`">
                <label for="">
                    {{ item.name }}
                </label>
            </div>
        </div>
    </ModalAdmin>
</template>
<script>
import { mapMutations, mapState } from 'vuex';
import Request from '../../../Request';
import ModalAdmin from '../ModalAdmin.vue';
export default {
    components: {
        ModalAdmin
    },
    computed: {
        ...mapState(['modal'])
    },
    props: ['list', 'title', 'handleSubmit', 'setList', 'name', 'table', 'id', 'status'],
    methods: {
        ...mapMutations(['setModal']),
        setLoading: function (status) {
            this.setModal({ ...this.modal, loading: status })
        },
        onChange: function (event) {
            this.statusUpdate = event.target.value
        },
        onSubmit: async function () {
            try {
                const result = await Request.Post(`/${this.table}-status`, {
                    id: this.id,
                    status: this.statusUpdate
                });
                this.setList(result.data.data);
                this.closeModal();
            } catch (error) {
                alert(error);
            }
        },
        closeModal: function () {
            this.setModal({ ...this.modal, loading: true, data: null })
        },
    },
    data() {
        return {
            statusUpdate: `${this.status}`
        }
    },
    mounted() {
        this.setLoading(true);
        this.setLoading(false);
    }
}
</script>