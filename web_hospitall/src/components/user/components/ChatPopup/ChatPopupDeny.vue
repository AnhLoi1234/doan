<template>
    <div class="loading__content">
        <div style="text-align: center;">
            <br />
            Yêu cầu bị từ chối , hệ thống sẽ chuyển trở lại form nhập thông tin. <p
                style="font-size: 3.6rem;font-weight: 900;text-align: center;margin: 2rem 0rem;">
                {{ count }}
            </p>
        </div>
    </div>
</template>
<script>
export default {
    props: ['setIsLogin'],
    data() {
        return {
            count: 3
        }
    },
    mounted() {
        const interval = setInterval(() => {
            if (this.count === 1) {
                clearInterval(interval);
                this.setIsLogin(0);
            }
            else {
                this.count -= 1;
            }
        }, 1000);
    }
}
</script>