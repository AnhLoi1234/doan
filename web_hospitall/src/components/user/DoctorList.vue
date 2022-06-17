<template>
    <div class="wrapper blog">
        <p class="profile__title">Danh sách bác sĩ</p>
        <div v-if="!loading" class="blog__list">
            <router-link v-for="item in list" :key="item.id" :to="{
                name: 'DoctorDetail', params: {
                    slug: item.info.slugspecical, id: item.info.idadmin
                }
            }" class="service__slider--item">
                <div class="item-doctor-image">
                    <img :src="urlImage + item.info.avatar" alt="" srcset="">
                </div>
                <div class="item-doctor-info">
                    <p>{{ item.info.name }}</p>
                    <p>{{ item.info.position }}</p>
                    <p>{{ item.info.namespecical }}</p>
                </div>
            </router-link>
        </div>
        <div v-else class="loading__content">
            <span class="bx bx-loader loading"></span>
        </div>
    </div>
</template>
<script>
import { URL_IMAGE } from '../../Config';
import Request from '../../Request';


export default {
    data() {
        return {
            loading: true,
            list: [],
            urlImage: URL_IMAGE
        }
    },
    mounted() {
        (async () => {
            try {
                const result = await Request.Get('/doctors');
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error);
            }
        })();
    }
}
</script>