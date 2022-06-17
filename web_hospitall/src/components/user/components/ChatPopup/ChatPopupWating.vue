<template>
    <div class="popup_waiting">
        <div>
            <p><span class="bx bx-loader loading"></span></p>
            <p>Đang chờ bác sĩ tư vấn...</p>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';

export default {
    props: ['setIsLogin', 'doctor', 'setData'],
    computed: {
        ...mapState(['socket'])
    },
    watch: {
        doctor: function (newData) {
            this.socket.on(`_acceptJoin.${newData?.idadmin}`, (data) => {
                this.setData(data);
                this.setIsLogin(data.typeAccess);
            });
        }
    }
}
</script>