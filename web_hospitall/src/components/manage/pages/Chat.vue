<template>
    <Base>
    <div class="chat">
        <div class="chat__left">
            <div class="chat__left--search">
                <input type="text" placeholder="Search">
                <span class="bx bx-search"></span>
            </div>
            <div class="chat__left--content">
                <div class="chat__item">
                    <div class="chat__item--image">
                        <img src="https://berrydashboard.io/static/media/user-round.13b5a31b.svg" alt="" srcset="">
                        <span></span>
                    </div>
                    <div class="chat__item--content">
                        <p>Le Dung</p>
                        <p>chao ban</p>
                    </div>
                    <div class="chat__item--time">
                        <p>09:00</p>
                        <p>1</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat__right">
            <div class="chat__right--top">
                <span style="cursor: pointer;">Xoa tat ca</span>
            </div>
            <ChatPopupContent />
        </div>
    </div>
    </Base>
</template>
<script>
import Base from "./Base.vue";
import ChatPopupContent from "../../ChatPopupContent.vue";
export default {
    components: {
        Base,
        ChatPopupContent
    }
}
</script>