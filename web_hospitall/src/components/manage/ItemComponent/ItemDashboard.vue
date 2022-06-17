<template>
    <div class="dashboard__item">
        <p class="dashboard__item--top">
            <span>{{ name }}</span>
            <span style="cursor: pointer;" @click="() => { this.$router.push({ name: route }) }" :class="icon"></span>
        </p>
        <div class="dashboard__item--length">
            <span :class="length === 0 || length ? '' : 'bx bx-loader loading'">
                {{ length === 0 || length ? length : '' }}
            </span>
        </div>
    </div>
</template>
<script>
export default {
    props: ['name', 'length', 'icon', 'route']
}
</script>