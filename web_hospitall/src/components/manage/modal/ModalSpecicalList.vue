<template>
    <ModalAdmin :id="id" :title="'Chuyên khoa'" :reset="reset" :nameButton="`${id ? 'Sửa' : 'Thêm'} chuyên khoa`"
        :onSubmit="onSubmit">
        <InputComponent :placeholder="'Nhập tên chuyên khoa'" icon="bx bx-pencil"
            :errorMessage="nameSpecical.error ? 'Tên chuyên khoa không được trống!' : ''" :onChange="onChange"
            name="nameSpecical" :value="nameSpecical.value" />
        <br />
        <div class="specicallist">
            <img :src="image.value || 'https:\\via.placeholder.com/200x200'"
                style="width: 20rem;height:20rem;object-fit:cover;" alt="" srcset="">
            <input type="file" @change="onChangeImage($event)" hidden id="select-file">
            <label for="select-file">
                Chọn ảnh chuyên khoa
            </label>
        </div>
        <br />
        <div>
            <VueEditor v-model="description"></VueEditor>
        </div>
    </ModalAdmin>
</template>
<script>
import ModalAdmin from "../ModalAdmin.vue";
import InputComponent from "../InputComponent.vue";
import { mapMutations, mapState } from "vuex";
import Request from "../../../Request";
import { URL_IMAGE } from "../../../Config";
import { VueEditor } from "vue3-editor";
export default {
    props: ['list', 'setList', 'id', 'reset'],
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
            nameSpecical: {
                value: '',
                error: false,
            },
            image: {
                value: null,
                error: false,
                file: null
            },
            data: null,
            description: ""
        }
    },
    methods: {
        ...mapMutations(['setModal']),
        onChangeImage: function (event) {
            this.image.value = URL.createObjectURL(event.target.files[0]);
            this.image.file = event.target.files[0];
        },
        setLoading: function (status) {
            this.setModal({ ...this.modal, loading: status })
        },
        closeModal: function () {
            this.setModal({ ...this.modal, loading: true, data: null })
        },
        onSubmit: async function () {
            this.nameSpecical.error = this.nameSpecical.value.length === 0;
            if (!this.nameSpecical.error && this.image.value) {
                let image;
                if (this.image.file) {
                    if (this.id) {
                        await Request.Post('/deleteImage', { image: this.data?.thumbnail })
                    }
                    const formData = new FormData();
                    formData.append('image', this.image.file);
                    image = await Request.Post('/uploadImage', formData);
                }
                const result = await Request[this.id ? 'Put' : 'Post']('/specicallists', {
                    id: this.id,
                    namespecical: this.nameSpecical.value,
                    thumbnail: image ? image.data.data : this.image.value.replace(URL_IMAGE, ''),
                    description: this.description
                });
                this.setList(result.data.data);
                this.reset();
                return true;
            }
        },
        onChange: function (event) {
            this[event.target.name].value = event.target.value;
            this[event.target.name].error = event.target.value.length === 0
        },
    },
    mounted() {
        (async () => {
            try {
                this.setLoading(true);
                if (this.id) {
                    //
                    const result = await Request.Get(`/specicallists/${this.id}`);
                    const data = result.data.data;
                    this.data = data;
                    this.nameSpecical.value = data.namespecical;
                    this.image.value = URL_IMAGE + data.thumbnail;
                    this.description = data.description_specical;
                }
                this.setLoading(false);
            } catch (error) {
                alert(error);
            }
        })();
    }
}
</script>
