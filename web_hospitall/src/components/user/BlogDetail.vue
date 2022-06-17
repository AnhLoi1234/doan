<template>
    <div v-if="!loading">
        <div v-if="blog" class="wrapper blog blog__flex">
            <div>
                <h1 class="blog__title">
                    {{ blog.title }}
                </h1>
                <div class="blog__child">
                    <span>{{ blog.type_blog === 0 ? 'Bài viết thông thườngg' : 'Bài viết công nghệ' }}</span>
                    <p>Thứ Hai, {{ blog.created_at }} +07:00</p>
                </div>
                <br />
                <hr />
                <br />
                <div v-html="blog.content" class="content__blog"></div>
            </div>
            <div>
                <ItemBlogDetail v-for="item in list" :key="item.id" :item="item" />
            </div>
        </div>
        <div class="wrapper">
            <br />
            <p class="reply__title">
                Bình luận ({{ comments.length }})
            </p>
            <div v-if="user" class="form-comment">
                <div class="order__form--textarea">
                    <textarea placeholder="Nội dung" name="content" @input="onChangeInput"
                        v-model="content.value"></textarea>
                    <span class="bx bxs-plus-circle"></span>
                </div>
                <p class="color-red" :class="content.error ? 'active' : 'hidden'">Nội dung không được trống</p>
                <br />
                <button v-if="!loadingButton" @click="onSubmit" class="order__form--button">
                    Bình luận
                </button>
                <button v-else class="order__form--button" :class="loadingButton ? 'disabled' : ''" disabled>
                    <span class="bx bx-loader loading"></span>
                </button>
            </div>
            <div v-if="comments.length === 0" class="loading__content">
                Không có bất kì bình luận nào.
            </div>
            <div v-else>
                <ItemReplyBlog v-for="item in comments" :key="item.id" :item="item" />
            </div>
        </div>
    </div>
    <div class="wrapper blog" v-else>
        <div class="loading__content">
            <span class="bx bx-loader loading"></span>
        </div>
    </div>
</template>
<script>
import Request from '../../Request';
import ItemBlogDetail from './components/ItemComponent/ItemBlogDetail.vue';
import ItemReplyBlog from './components/ItemComponent/ItemReplyBlog.vue';
import { mapState } from 'vuex';

export default {
    components: { ItemBlogDetail, ItemReplyBlog },
    data() {
        return {
            blog: null,
            loading: true,
            list: [],
            comments: [],
            loadingButton: false,
            content: {
                value: '',
                error: false
            },
            // fullname: {
            //     value: '',
            //     error: false
            // },
        }
    },
    computed: {
        ...mapState(['user'])
    },
    methods: {
        onChangeInput: function (event) {
            this[event.target.name].value = event.target.value;
            this[event.target.name].error = event.target.value.length === 0;
        },
        onSubmit: async function () {
            this.loadingButton = true;
            this.content.error = this.content.value.length === 0;
            if (!this.content.error) {
                const result = await Request.Post('/commentBlogs', {
                    fullname: this.user?.fullname,
                    content: this.content.value,
                    iduser: this.user?.id,
                    idblog: this.blog?.id
                });
                this.comments = [...this.comments, result.data.data];
                this.content.value = '';
            }
            this.loadingButton = false;
        },
        fetchData: async function () {
            try {
                this.loading = true;
                let result = await Request.Post('/blog-slug', {
                    slug: this.$route.params.slug
                });
                await Request.Get(`/update-view-blog/${this.$route.params.slug}`);
                this.blog = result.data.data;
                result = await Request.Post('/blog-different', {
                    slug: this.$route.params.slug
                });
                this.list = result.data.data;
                result = await Request.Get(`/commentBlogs/${this.$route.params.slug}`);
                this.comments = result.data.data;
                this.loading = false;
            } catch (error) {
                // alert(error);
                console.log(error);
            }
        }
    },
    watch: {
        $route() {
            this.fetchData();
        }
    },
    mounted() {
        this.fetchData();
    }
}
</script>
<style>
.disabled {
    opacity: 0.5 !important;
    cursor: not-allowed;
}
</style>