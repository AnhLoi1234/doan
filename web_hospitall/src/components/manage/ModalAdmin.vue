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
                <button v-if="disabled || disabledButton" disabled class="order__form--button disabled"><span
                        class="bx bx-loader loading"></span></button>
                <button v-else @click="submitForm" class="order__form--button">{{ nameButton
                }}</button>
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
    props: ['title', 'nameButton', 'onSubmit', 'reset', 'disabled'],
    computed: {
        ...mapState(["modal"])
    },
    data() {
        return {
            loadingButton: false,
            disabledButton: false
        }
    },
    methods: {
        ...mapMutations(["setModal"]),
        closeModal: function () {
            this.setModal({ ...this.modal, data: null, loading: true, info: null });
            if (this.reset) {
                this.reset();
            }
        },
        submitForm: async function () {
            this.disabledButton = true;
            this.loadingButton = true;
            const result = await this.onSubmit();
            if (result) {
                this.closeModal();
                this.loadingButton = false;
                this.disabledButton = false;
            }
        }
    }
}
</script>
<style>
.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>