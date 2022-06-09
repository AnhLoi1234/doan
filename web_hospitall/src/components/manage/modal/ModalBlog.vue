<template>
    <ModalAdmin title="Bài viết" :reset="reset" :nameButton="`${id ? 'Sửa' : 'Thêm'} bài viết`" :onSubmit="onSubmit">
        <InputComponent :placeholder="'Nhập tiêu đề'" type="text" name="title" :icon="'bx bx-user'" :onChange="onChange"
            :value="title.value">
        </InputComponent>
        <div class="select_admin">
            <select @change="onChange($event)" name="typeBlog">
                <option value="0">
                    Bài viết thông thường
                </option>
                <option value="1">
                    Bài viết công nghệ
                </option>
            </select>
            <span class="bx bx-chevron-down"></span>
        </div>
        <br />
        <div class="specicallist">
            <img :src="image.value || 'https:\\via.placeholder.com/200x200'"
                style="width: 20rem;height:15rem;object-fit:cover;" alt="" srcset="">
            <input type="file" @change="onChangeImage($event)" hidden id="select-files">
            <label for="select-files">
                Chọn ảnh thu nhỏ
            </label>
        </div>
        <p v-if="image.error" class="color-red">{{ 'Ảnh thu nhỏ không được trống' }}></p>
        <br />
        <div>
            <VueEditor v-model="content" />
        </div>
    </ModalAdmin>
</template>
<script>
import { mapMutations, mapState } from "vuex";
import ModalAdmin from "../ModalAdmin.vue";
import InputComponent from "../InputComponent.vue";
import { VueEditor } from "vue3-editor";
import Request from "../../../Request";
import { URL_IMAGE } from "../../../Config";
export default {
    props: ['id', 'setList', 'reset'],
    components: {
        ModalAdmin,
        InputComponent,
        VueEditor
    },
    computed: {
        ...mapState(['modal'])
    },
    data() {
        return {
            title: {
                value: '',
                error: false
            },
            image: {
                value: '',
                error: false,
                file: null
            },
            data: null,
            content: '',
            typeBlog: {
                value: "0",
                error: false
            }
        }
    },
    methods: {
        ...mapMutations(['setModal']),
        setLoading: function (status) {
            this.setModal({ ...this.modal, loading: status })
        },
        onChange: function (event) {
            this[event.target.name].value = event.target.value;
            this[event.target.name].error = event.target.value.length === 0
        },
        onChangeImage: function (event) {
            this.image.value = URL.createObjectURL(event.target.files[0]);
            this.image.file = event.target.files[0];
        },
        onSubmit: async function () {
            this.image.error = !this.image.value;
            if (!this.image.error && !this.title.error) {
                let image;
                if (this.image.file) {
                    if (this.id) {
                        await Request.Post('/deleteImage', { image: this.data?.thumbnail })
                    }
                    const formData = new FormData();
                    formData.append('image', this.image.file);
                    image = await Request.Post('/uploadImage', formData);
                }
                const result = await Request[this.id ? 'Put' : 'Post']('/blogs', {
                    id: this.id,
                    thumbnail: image ? image.data.data : this.image.value.replace(URL_IMAGE, ''),
                    title: this.title.value,
                    content: this.content,
                    typeBlog: this.typeBlog.value
                });
                this.setList(result.data.data);
                this.reset();
                return true;
            }
        }
    },
    mounted() {
        (async () => {
            try {
                this.setLoading(true);
                if (this.id) {
                    const result = await Request.Get(`/blogs/${this.id}`);
                    if (result.data.data) {
                        this.title.value = result.data.data.title
                        this.image.value = URL_IMAGE + result.data.data.thumbnail;
                        this.content = result.data.data.content;
                        this.data = result.data.data;
                    }
                }
                this.setLoading(false);
            } catch (error) {
                alert(error);
            }
        })();
    }
}
</script>