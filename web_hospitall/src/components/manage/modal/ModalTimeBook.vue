<template>
    <ModalAdmin :id="id" :title="'Thời gian đặt'" :reset="reset" :nameButton="`${id ? 'Sửa' : 'Thêm'} thời gian đặt`"
        :onSubmit="onSubmit">
        <InputComponent :type="'text'" :placeholder="'Nhập thời gian'" :onChange="onChange" :icon="'bx bx-time'"
            :errorMessage="time.error ? 'Thời gian không được trống' : null" :name="'time'" :value="time.value">
        </InputComponent>
    </ModalAdmin>
</template>
<script>
import ModalAdmin from '../ModalAdmin.vue';
import InputComponent from '../InputComponent.vue';
import { mapMutations, mapState } from 'vuex';
import Request from '../../../Request';

export default {
    props: ['id', 'setList', 'list', 'reset'],
    components: { ModalAdmin, InputComponent },
    computed: {
        ...mapState(['modal'])
    },
    data() {
        return {
            time: {
                value: '',
                error: null
            },
            data: null
        }
    },
    methods: {
        ...mapMutations(['setModal']),
        setLoading: function (status) {
            this.setModal({ ...this.modal, loading: status })
        },
        closeModal: function () {
            this.setModal({ ...this.modal, loading: true, data: null })
        },
        onSubmit: async function () {
            this.time.error = this.time.value.length === 0

            if (!this.time.error) {
                //
                try {
                    let result;
                    if (this.id) {
                        result = await Request.Put('/timebooks', {
                            time: this.time.value,
                            id: this.id
                        })
                    }
                    else {
                        result = await Request.Post('/timebooks', { time: this.time.value })
                    }
                    this.setList(result.data.data);
                    this.reset();
                    this.closeModal();
                } catch (error) {
                    alert(error);
                }
            }
        },
        onChange: function (event) {
            this[event.target.name].value = event.target.value;
            this[event.target.name].error = event.target.value.length === 0;
        }
    },
    mounted() {
        (async () => {
            try {
                this.setLoading(true)
                if (this.id) {
                    const result = await Request.Get(`/timebooks/${this.id}`);
                    if (result.data.data) {
                        const data = result.data.data;
                        this.time.value = data.time;
                        this.data = data;
                    }
                    else {
                        alert('Lỗi dữ liệu.')
                        this.closeModal()
                    }
                }
                this.setLoading(false)
            } catch (error) {
                alert(error);
            }
        })()
    }
}
</script>