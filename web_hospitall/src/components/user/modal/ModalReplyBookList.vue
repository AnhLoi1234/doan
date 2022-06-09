<template>
    <ModalUser :onSubmit="onSubmit" title="Phản hồi lịch khám" nameButton="Phản hồi">
        <div class="form-comment">
            <div class="order__form--textarea">
                <textarea placeholder="Nhập phản hồi của bạn" name="content" @input="onChangeInput"></textarea>
                <span class="bx bxs-plus-circle"></span>
            </div>
            <p class="color-red" :class="content.error ? 'active' : 'hidden'">Nội dung không được trống</p>
            <br />
        </div>
    </ModalUser>
</template>
<script>
import { mapMutations, mapState } from 'vuex';
import Request from '../../../Request';
import ModalUser from '../ModalUser.vue';

export default {
    props: ['idbooklist', 'iddoctor', 'setList'],
    components: { ModalUser },
    computed: {
        ...mapState(['user', 'modalUser'])
    },
    data() {
        return {
            loadingButton: false,
            content: {
                value: '',
                error: false
            }
        }
    },
    methods: {
        ...mapMutations(['setModalUser']),
        onChangeInput: function (event) {
            this[event.target.name].value = event.target.value;
            this[event.target.name].error = event.target.value.length === 0;
        },
        onSubmit: async function () {
            try {
                this.loadingButton = true;
                this.content.error = this.content.value.length === 0;
                if (!this.content.error) {
                    await Request.Post('/replyUsers', {
                        content: this.content.value,
                        iduser: this.user?.id,
                        idadmin: this.iddoctor,
                        idbooklist: this.idbooklist
                    });
                    await Request.Post('/booklist-status', {
                        id: this.idbooklist,
                        status: 3
                    })
                    this.setList(this.idbooklist)
                    return true;
                }
                this.loadingButton = false;
            } catch (error) {
                alert(error);
            }
        },
    },
    mounted() {
        this.setModalUser({ ...this.modalUser, loading: false });
    }
}
</script>