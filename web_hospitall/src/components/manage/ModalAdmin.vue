<template>
    <div class="admin_modal" :class="modal.data ? 'active' : ''">
        <div class=" admin_modal__main">
            <div class="admin_modal__main--title">
                {{ title }}
            </div>
            <span @click="closeModal" class="admin_modal__main--close bx bx-x"></span>
            <div class="admin_modal__main--content">
                <br />
                <slot></slot>
                <br />
                <button @click="submitForm" class="order__form--button"><span
                        :class="loadingButton ? 'bx bx-loader loading' : ''">
                        {{ loadingButton ? '' : nameButton }}</span></button>
            </div>
            <div v-if="modal.loading" class="admin_modal__loading">
                <span class='bx bx-loader-alt loading'></span>
            </div>
        </div>
        <div @click="closeModal" class="admin_modal__overlay" :class="modal.loading ? 'active' : ''"></div>
    </div>
</template>
<script>
import { mapMutations, mapState } from 'vuex';

export default {
    props: ['title', 'nameButton', 'onSubmit', 'reset'],
    computed: {
        ...mapState(["modal"])
    },
    data() {
        return {
            loadingButton: false,
        }
    },
    methods: {
        ...mapMutations(["setModal"]),
        closeModal: function () {
            this.setModal({ ...this.modal, data: null, loading: true });
            if (this.reset) {
                this.reset();
            }
        },
        submitForm: async function () {
            this.loadingButton = true;
            const result = await this.onSubmit();
            if (result) {
                this.closeModal();
            }
            this.loadingButton = false;
        }
    }
}
</script>