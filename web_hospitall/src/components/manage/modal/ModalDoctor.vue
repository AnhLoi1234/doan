<template>
    <ModalAdmin :onSubmit="onSubmit" :title="'Bác sĩ'" :disabled="edit !== 3 && admin?.role != 0"
        :nameButton="`${id ? 'Sửa' : 'Thêm'} bác sĩ`">
        <div v-if="admin?.role != 0" class="specicallist flex-space-between">
            <label v-if="edit !== 1" class="left-0" @click="writeDescription(edit - 1)" for="">
                Trở về
            </label>
            <label v-if="edit !== 3" class="right-0" @click="writeDescription(edit + 1)" for="">
                Tiếp tục
            </label>
        </div>
        <br />
        <div v-if="edit === 1">
            <div class="flex">
                <div class="w-50">
                    <InputComponent placeholder="Nhập tên bác sĩ" type="text" icon="bx bx-user"
                        :errorMessage="nameDoctor.error ? 'Tên bác sĩ không được trống' : ''" :onChange="onChange"
                        name="nameDoctor" :value="nameDoctor.value">
                    </InputComponent>
                </div>
                <div class="w-50">
                    <InputComponent placeholder="Nhập tên đăng nhập" type="text" icon="bx bx-user-pin"
                        :errorMessage="username.error ? 'Tên đăng nhập không được trống' : ''" :onChange="onChange"
                        name="username" :value="username.value">
                    </InputComponent>
                </div>
            </div>
            <div class="flex">
                <div class="w-50" style="display: flex;align-items: center;transform: translateY(-0.3rem);">
                    <div class="select_admin">
                        <select @change="onChange($event)" name="position" v-model="position.value">
                            <option value="Tiến sĩ, Bác sĩ">
                                Tiến sĩ, Bác sĩ
                            </option>
                            <option value="Thạc sĩ, Bác sĩ">
                                Thạc sĩ, Bác sĩ
                            </option>
                            <option value="Giáo sư, Bác sĩ">
                                Giáo sư, Bác sĩ
                            </option>
                            <option value="Tiến sĩ, Thạc sĩ, Bác sĩ">
                                Tiến sĩ, Thạc , Bác sĩ
                            </option>
                            <option value="P. Tiến sĩ, Thạc sĩ, Bác sĩ">
                                P. Tiến sĩ, Thạc sĩ, Bác sĩ
                            </option>
                            <option value="Giáo sư, Bác sĩ">
                                Giáo sư, Tiến sĩ ,Bác sĩ
                            </option>
                        </select>
                        <span class="bx bx-chevron-down"></span>
                    </div>

                </div>
                <div class="w-50" style="display: flex;align-items: center;transform: translateY(-0.3rem);">
                    <div class="select_admin">
                        <select @change="onChange($event)" name="address" v-model="address.value">
                            <option v-for="item in addresses" :key="item.id" :value="item._name">
                                {{ item._name }}
                            </option>
                        </select>
                        <span class="bx bx-chevron-down"></span>
                    </div>

                </div>
            </div>
            <div class="flex">
                <div class="w-50">
                    <InputComponent placeholder="Nhập số điện thoại" type="text" icon="bx bx-phone" :errorMessage="!phone.error ? '' : phone.error === 1 ? 'Số điện thoại không được trống' :
                    'Số điện thoại không đúng định dạng'" :onChange="onChange" name="phone" :value="phone.value">
                    </InputComponent>
                </div>
                <div class="w-50">
                    <InputComponent placeholder="Nhập mật khẩu" type="password" icon="bx bx-lock-alt"
                        :errorMessage="password.error ? 'Mật khẩu không được trống' : ''" :onChange="onChange"
                        name="password">
                    </InputComponent>
                </div>
            </div>
            <p style="padding-bottom: 1rem;font-size: 1.5rem;font-weight:600;">Chuyên khoa</p>
            <div class="select_admin">
                <select name="specicallist" v-model="specicallist.value" @change="onChange($event)">
                    <option value=""></option>
                    <option v-for="special in specicals" :key="special" :value="special.id"
                        :selected="specicallist.value">
                        {{ special.namespecical }}
                    </option>
                </select>
                <span class="bx bx-chevron-down"></span>
            </div>
            <p class="color-red"></p>
            <br />
            <div class="specicallist">
                <img :src="image.value || 'https:\\via.placeholder.com/200x200'"
                    style="width: 20rem;height:20rem;object-fit:cover;border-radius:100rem;" alt="" srcset="">
                <input type="file" @change="onChangeImage($event)" hidden id="select-file">
                <label for="select-file">
                    Chọn ảnh bác sĩ
                </label>
            </div>
        </div>
        <div v-if="edit === 2 && admin?.role == 1">
            <VueEditor v-model="description.value" />
        </div>
        <div v-if="edit === 3 && admin?.role == 1">
            <ItemTimeDoctor :id="id" :setCurrent="setCurrent" :currentData="current" />
        </div>
    </ModalAdmin>
</template>
<script>
import ModalAdmin from "../ModalAdmin.vue";
import InputComponent from "../InputComponent.vue";
import { mapMutations, mapState } from "vuex";
import { VueEditor } from "vue3-editor";
import { REGEX_EMAIL, REGEX_NUMBER_PHONE, URL_IMAGE } from "../../../Config";
import Request from "../../../Request";
import ItemTimeDoctor from "../ItemComponent/ItemTimeDoctor.vue";

export default {
    props: ['id', 'setList', 'reset'],
    components: {
        InputComponent,
        ModalAdmin,
        VueEditor,
        ItemTimeDoctor
    },
    data() {
        return {
            urlImage: URL_IMAGE,
            specicals: [],
            edit: 1,
            position: {
                value: '',
                error: false
            },
            address: {
                value: '',
                error: false
            },
            password: {
                value: '',
                error: false
            },
            nameDoctor: {
                value: '',
                error: false
            },
            username: {
                value: '',
                error: ''
            },
            phone: {
                value: '',
                error: ''
            },
            email: {
                value: '',
                error: ''
            },
            specicallist: {
                value: '',
                error: ''
            },
            description: {
                value: 'Chưa có mô tả',
                error: ''
            },
            listTime: [],
            image: {
                value: '',
                file: null,
            },
            data: null,
            current: [],
            backupCurrent: [],
            addresses: []
        }
    },
    methods: {
        ...mapMutations(['setModal']),
        setLoading: function (status) {
            this.setModal({ ...this.modal, loading: status })
        },
        writeDescription: function (edit) {
            this.edit = edit;
        },
        onChange: function (event) {
            this[event.target.name].value = event.target.value;
            switch (event.target.name) {
                case 'phone':
                    this[event.target.name].error = event.target.value.length === 0 ? 1 :
                        !event.target.value.match(REGEX_NUMBER_PHONE) ? 2 : false
                    break;
                case 'email':
                    this[event.target.name].error = event.target.value.length === 0 ? 1 :
                        !event.target.value.match(REGEX_EMAIL) ? 2 : false
                    break;
                case 'password':
                    break;
                default:
                    this[event.target.name].error = event.target.value.length === 0
                    break;
            }
        },
        onChangeImage: function (event) {
            this.image.value = URL.createObjectURL(event.target.files[0]);
            this.image.file = event.target.files[0];
        },
        setCurrent: function (list) {
            this.current = list;
        },
        onSubmit: async function () {
            try {
                let image;
                if (this.image.file) {
                    if (this.id) {
                        await Request.Post('/deleteImage', { image: this.data?.avatar })
                    }
                    const formData = new FormData();
                    formData.append('image', this.image.file);
                    image = await Request.Post('/uploadImage', formData);
                }
                const doctor = await Request[this.id ? 'Put' : 'Post']('/doctors', {
                    idadmin: this.id,
                    fullname: this.nameDoctor.value,
                    password: this.password.value,
                    updatePassword: this.password.value.length === 0 ? 'false' : 'true',
                    avatar: image ? image.data.data : this.image.value.replace(URL_IMAGE, ''),
                    phone: this.phone.value,
                    role: 1,
                    username: this.username.value,
                    idspecicallist: this.specicallist.value,
                    address: this.address.value,
                    position: this.position.value,
                    description: this.description.value
                });
                if (this.id) {
                    let dataNew = [];
                    let dataOld = [];
                    for (let i = 0; i < this.backupCurrent.length; i++) {
                        const item = this.backupCurrent[i];
                        const index = [...this.current].findIndex(dt => dt.day === item.day && dt.month === item.month &&
                            dt.year === item.year);
                        if (index === -1) {
                            dataOld = [...dataOld, item];
                        }
                    }
                    for (let i = 0; i < this.current.length; i++) {
                        const item = this.current[i];
                        const index = [...this.backupCurrent].findIndex(dt => dt.day === item.day && dt.month === item.month &&
                            dt.year === item.year);
                        if (index === -1) {
                            dataNew = [...dataNew, item];
                        }
                    }
                    for (let index = 0; index < dataOld.length; index++) {
                        await Request.Post('/timedoctor-delete', dataOld[index]);
                    }
                    for (let index = 0; index < dataNew.length; index++) {
                        await Request.Post('/timedoctors', { ...dataNew[index], idadmin: this.data.info.idadmin });
                    }
                }
                else {
                    for (let index = 0; index < this.current.length; index++) {
                        await Request.Post('/timedoctors', { ...this.current[index], idadmin: doctor.data.data.idadmin });
                    }
                }
                this.setList && this.setList(doctor.data.data);
                this.reset && this.reset();
                return true;
            } catch (error) {
                console.log(error)
            }
        }
    },
    computed: {
        ...mapState(['modal', 'admin'])
    },
    mounted() {
        (async () => {
            try {
                this.setLoading(true);
                let result = await Request.Get('/specicallists');
                this.specicals = result.data.data;
                this.setLoading(false);
                if (this.id) {
                    result = await Request.Get(`/doctors/${this.id}`);
                    const data = result.data.data;
                    this.data = data;
                    this.username.value = data.info.username;
                    this.position.value = data.info.position;
                    this.address.value = data.info.address;
                    this.image.value = this.urlImage + data.info.avatar;
                    this.phone.value = data.info.sdt;
                    this.specicallist.value = data.info.idspecicallist;
                    this.nameDoctor.value = data.info.name;
                    this.description.value = data.info.description_admin;
                }
                result = await Request.Get(`/timedoctors/${this.id}`);
                this.current = result.data.data;
                this.backupCurrent = (result.data.data);
                result = await Request.Get('/provinces');
                this.addresses = result.data.data;
                return true;
            } catch (error) {
                alert(error);
            }
        })();
    }

}
</script>