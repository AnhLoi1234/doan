<template>
    <div class="container">
        Chào Mừng Đến với trang quản Lý
    </div>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    beforeCreate() {
        if(!window.localStorage.getItem("token")){
            this.$router.push({name:'admin_login'})
        }
    },
}
</script>

<style scoped>

</style>