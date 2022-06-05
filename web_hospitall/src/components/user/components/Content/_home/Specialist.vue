<template>
    <div class="wrapper">
        <h2 class="item__post--heading">
            Chuyên khoa phổ biến
        </h2>
        <div class="item__post__ row">
            <div class="item__post">
                <ItemSpecialList v-for="item in list" :item="item" :key="item.id"></ItemSpecialList>
            </div>
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