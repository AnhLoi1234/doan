<template>
    <div class="wrapper">
        <p class="item__post--heading">
            Danh sách bác sĩ
        </p>
        <div class="row">
            <div class="blog__list">
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
        </div>
    </div>
</template>
<script>
import { URL_IMAGE } from '../../../../../Config';
import Request from '../../../../../Request';

export default {
    data() {
        return {
            list: [],
            urlImage: URL_IMAGE
        }
    },
    mounted() {
        (async () => {
            try {
                const result = await Request.Get('/doctors');
                this.list = result.data.data;
            } catch (error) {
                alert(error);
            }
        })();
    }
}
</script>