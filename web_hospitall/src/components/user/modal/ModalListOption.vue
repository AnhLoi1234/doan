<template>
    <div class="list-option">
        <div class="list-option__top">
            <span @click="closeModal" class="bx bx-left-arrow-alt list-option__top--prev"></span>
            <p>Chuyên khoa "{{ namespecical }}"</p>
        </div>
        <div v-if="!loading" class="list-option__content">
            <div v-if="list.length > 0">
                <a @click="handleClick(item)" v-for="item in list" :key="item.id" class="list-option__item">
                    <div class="list-option__item--image img-wrap">
                        <img :src="urlImage + item.thumbnail" alt="">
                    </div>
                    <p class="list-option__item--text">{{ item.namespecical }}</p>
                </a>
            </div>
            <div v-else>
                Không có chuyên khoa cho từ khoá <b>"{{ namespecical }}"</b>
            </div>
        </div>
        <div v-else class="loading__content">
            <span class="bx bx-loader loading"></span>
        </div>
    </div>
</template>
<script>
import { mapMutations, mapState } from 'vuex';
import { URL_IMAGE } from '../../../Config';
import Request from '../../../Request';

export default {
    props: ['namespecical'],
    computed: {
        ...mapState(['modalUser'])
    },
    methods: {
        ...mapMutations(['setModalUser']),
        closeModal: function () {
            this.setModalUser({ ...this.modalUser, loading: true, data: false });
        },
        handleClick: function (item) {
            this.closeModal();
            this.$router.push({ name: 'Doctors', params: { slug: `${item.slugspecical}` } })
        }
    },
    data() {
        return {
            urlImage: URL_IMAGE,
            list: [],
            loading: true
        }
    },
    mounted() {
        (async () => {
            try {
                //
                const result = await Request.Post('/specicallist-search', {
                    value: this.namespecical
                });
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error);
            }
        })();
    }
}
</script>