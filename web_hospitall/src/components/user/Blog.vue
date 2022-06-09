<template>
    <div class="wrapper blog">
        <p class="profile__title">Cẩm nang</p>
        <div v-if="!loading0" class="blog__list">
            <ItemBlog v-for="item in type0" :key="item.id" :item="item" />
        </div>
        <div v-else class="loading__content">
            <span class="bx bx-loader loading"></span>
        </div>
        <p class="profile__title">Công nghệ</p>
        <div v-if="!loading1" class="blog__list">
            <ItemBlog v-for="item in type1" :key="item.id" :item="item" />
        </div>
        <div v-else class="loading__content">
            <span class="bx bx-loader loading"></span>
        </div>

    </div>
</template>
<script>
import Request from '../../Request';
import ItemBlog from './components/ItemComponent/ItemBlog.vue';
export default {
    components: { ItemBlog },
    data() {
        return {
            type0: [],
            type1: [],
            loading0: true,
            loading1: true
        }
    },
    mounted() {
        (async () => {
            try {
                let result = await Request.Get("/blog-user/0");
                this.type0 = result.data.data;
                this.loading0 = false;
                result = await Request.Get("/blog-user/1");
                this.type1 = result.data.data;
                this.loading1 = false;
            } catch (error) {
                alert(error);
            }
        })();
    }
}
</script>