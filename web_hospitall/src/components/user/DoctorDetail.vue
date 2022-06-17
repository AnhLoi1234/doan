<template>
    <div v-if="!loading">
        <div v-if="book">
            <div class="wrapper breadcrumb">
                <ul>
                    <li><a href="" class="bx bxs-home"></a></li>
                    <li class="line">/</li>
                    <li><a href="">Bác sĩ</a></li>
                    <li class="line">/</li>
                    <li><a href="">{{ specical ? specical.namespecical : '' }}</a></li>
                </ul>
            </div>
            <div class="wrapper">
                <div class="order__item--left detail" style="margin-bottom: 3rem;">
                    <div>
                        <img class="order__item--left--image detail" :src="urlImage + book.doctor.info.avatar" alt=""
                            srcset="">
                    </div>
                    <div class="order__item--left--content">
                        <h3>{{ book.doctor.info.position }} {{ book.doctor.info.name }}</h3>
                        <div v-html="book.doctor.info.description_admin"></div>
                        <div class="order__item--left--content--footer">
                            <span class="bx bx-current-location"></span>
                            <span>{{ book.doctor.info.address }}</span>
                        </div>
                        <div class="post__socical">
                            <button>
                                <span class="bx bxs-like"></span>
                                <span>Like</span>
                            </button>
                            <button>
                                <span class="bx bxs-share"></span>
                                <span>Share</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="order__item--right row">
                    <div class="col-lg-7">
                        <ItemCalendar :times="times" :doctor="book.doctor" :isDetail="true" :time_="book.time">
                        </ItemCalendar>
                    </div>
                    <div class="" style="flex: 1;flex-wrap: wrap;">
                        <ul class="col-12">
                            <li>ĐỊA CHỈ KHÁM</li>
                            <li>Bệnh viện Ung bướu Hưng Việt</li>
                            <li>34 Đại Cồ Việt, Hai Bà Trưng, Hà Nội</li>
                        </ul>
                    </div>
                </div>
                <button v-if="book.time" @click="orderNow()" class="button-order">
                    ĐẶT LỊCH NGAY
                </button>
                <button v-else class="button-order disabled" disabled>
                    ĐẶT LỊCH NGAY
                </button>
            </div>
            <div class="order__container show ">
                <div v-if="specical" class="wrapper" style="padding: 2rem;">
                    <h3>{{ specical.namespecical }}</h3>
                    <h4>Bác sĩ Chuyên khoa {{ specical.namespecical }}</h4>
                    <p v-html="specical.description_specical"></p>
                </div>
            </div>
            <div class="wrapper">
                <div class="reply">
                    <p class="reply__title">
                        Phản hồi của bệnh nhân sau khi đi khám
                    </p>
                    <div v-if="replies.length > 0">
                        <ItemReplyBookList v-for="item in replies" :key="item.id" :item="item" />
                    </div>
                    <div v-else class="loading__content">
                        Chưa có bất kì phản hồi nào.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="loading__content">
        <span class="bx bx-loader loading"></span>
    </div>
</template>
<script>
import { mapMutations, mapState } from 'vuex';
import { URL_IMAGE } from '../../Config';
import Request from '../../Request';
import ItemCalendar from './components/ItemComponent/ItemCalendar.vue';
import ItemReplyBookList from './components/ItemComponent/ItemReplyBookList.vue';
export default {
    data() {
        return {
            times: [],
            specical: null,
            urlImage: URL_IMAGE,
            isShowReply: false,
            loading: true,
            replies: []
        };
    },
    methods: {
        ...mapMutations(['setBook']),
        orderNow: function () {
            this.$router.push({
                name: "DoctorForm", params: {
                    slug: this.$route.params.slug
                }
            });
        },

    },
    computed: {
        ...mapState(["book", "user"])
    },
    watch: {
        book: function (newData) {
            if (newData?.doctor?.dates?.length === 0) {
                alert("Hiện tại bác sĩ này chưa có lịch đặt khám trong những ngày tới.. Vui lòng trở lại sau");
                this.$router.push({
                    name: "Doctors", params: {
                        slug: this.$route.params.slug
                    }
                });
            }
        }
    },
    mounted() {
        (async () => {
            try {
                this.loading = true;
                let result = await Request.Get(`/doctors/${this.$route.params.id}`);
                this.setBook({
                    ...this.book,
                    doctor: result.data.data,
                });
                result = await Request.Get("/timebooks");
                this.times = result.data.data;
                result = await Request.Post("/specicallist-slug", {
                    slug: this.$route.params.slug
                });
                this.specical = result.data.data;
                result = await Request.Post('/reply-user-check', {
                    iduser: this.user?.id,
                    iddoctor: this.book?.doctor?.info?.idadmin
                });
                this.isShowReply = result.data.status;
                result = await Request.Get(`/replyUsers/${this.book?.doctor?.info?.idadmin}`);
                this.replies = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error);
            }
        })();
    },
    components: { ItemCalendar, ItemReplyBookList }
}
</script>
<style>
.disabled {
    cursor: not-allowed !important;
    opacity: 0.5 !important;
}
</style>