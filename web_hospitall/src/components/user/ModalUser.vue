<template>
    <div class="admin_modal" :class="modalUser.data ? 'active' : ''">
        <div class=" admin_modal__main">
            <div class="admin_modal__main--title">
                {{ title }}
            </div>
            <span @click="closeModal" class="admin_modal__main--close bx bx-x"></span>
            <div class="admin_modal__main--content">
                <br />
                <slot></slot>
                <br />
                <button :disabled="disabled || disabledButton ? true : false" @click="submitForm"
                    class="order__form--button" :class="disabled || disabledButton ? 'disabled' : ''"><span
                        :class="loadingButton ? 'bx bx-loader loading' : ''">
                        {{ loadingButton ? '' : nameButton }}</span></button>
            </div>
            <div v-if="modalUser.loading" class="admin_modal__loading">
                <span class='bx bx-loader-alt loading'></span>
            </div>
        </div>
        <div @click="closeModal" class="admin_modal__overlay" :class="modalUser.loading ? 'active' : ''"></div>
    </div>
</template>
<script>
import { mapMutations, mapState } from 'vuex';

export default {
    props: ['title', 'nameButton', 'onSubmit', 'reset', 'disabled'],
    computed: {
        ...mapState(["modalUser"])
    },
    data() {
        return {
            loadingButton: false,
            disabledButton: false
        }
    },
    methods: {
        ...mapMutations(["setModalUser"]),
        closeModal: function () {
            this.setModalUser({ ...this.modalUser, data: null, loading: true });
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