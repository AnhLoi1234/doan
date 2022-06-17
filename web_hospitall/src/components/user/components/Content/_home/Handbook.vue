<template>
    <div class="wrapper">
        <p class="item__post--heading">
            Bài viết
        </p>
        <div class="row">
            <div class="item__guide">
                <router-link :to="{
                    name: 'BlogDetail', params: {
                        slug: item.slug_blog
                    }
                }" v-for="item in list" :key="item.id" class="item__guide--item">
                    <div class="item__guide--item--image col-4 img-wrap"
                        :style="{ background: `url(${urlImage + item.thumbnail})` }">
                    </div>
                    <div>
                        <p class="item__guide--item--text col-8">
                            {{ item.title }} <br />
                        </p>
                        <!-- <p> {{ item.created_at }}</p> -->
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
import { URL_IMAGE } from '../../../../../Config'
import Request from '../../../../../Request'

export default {
    data() {
        return {
            urlImage: URL_IMAGE,
            list: []
        }
    },
    mounted() {
        (async () => {
            try {
                const result = await Request.Get('/blog-user/0');
                this.list = result.data.data;
            } catch (error) {
                alert(error);
            }
        })()
    }
}
</script>