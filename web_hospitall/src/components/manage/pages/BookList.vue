<template>
    <Base>
    <Table :title="'Danh sách lịch đặt khám'"
        :heading="['Tên khách hàng', 'Số điện thoại', 'Tên bác sĩ', 'Thời gian khám', 'Thời gian đặt']">

    </Table>
    </Base>
</template>
<script>
import Base from "./Base.vue";
import Table from "../Table.vue";
export default {
    components: {
        Base,
        Table
    },
    data() {
        return {

        }
    },
    mounted() {
        (async () => {
            try {
                //
            } catch (error) {
                alert(error);
            }
        })();
    }
}
</script>