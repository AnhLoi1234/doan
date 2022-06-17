<template>
    <div class="wrapper">
        <h2 class="item__post--heading">
            Chuyên khoa phổ biến
        </h2>
        <div class="item__post__ row">
            <span @click="handleClick(true)" class="bx bx-chevron-left button-slider left"></span>
            <div class="item__post" :style="{ transition: '0.3s', transform: `translateX(-${index * 25}%)` }">
                <ItemSpecialList v-for="item in list" :item="item" :key="item.id"></ItemSpecialList>
            </div>
            <span @click="handleClick()" class="bx bx-chevron-right button-slider right"></span>
        </div>
    </div>
</template>
<script>
import Request from "../../../../../Request";
import ItemSpecialList from '../../ItemComponent/ItemSpecialList.vue';
export default {
    components: { ItemSpecialList },
    data() {
        return {
            list: [],
            index: 0
        }
    },
    methods: {
        handleClick: function (isLeft) {
            if (isLeft) {
                this.index = this.index - 1 < 0 ? this.list.length - 4 : this.index - 1
            }
            else {
                this.index = this.index + 1 > this.list.length - 4 ? 0 : this.index + 1
            }
        }
    },
    mounted() {
        (async () => {
            const result = await Request.Get('/specicallists');
            this.list = result.data.data;
        })();
    }
}
</script>