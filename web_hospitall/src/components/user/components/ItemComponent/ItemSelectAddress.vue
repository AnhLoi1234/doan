<template>
    <div class="order__form--select">
        <span class="bx bx-current-location"></span>
        <select :name="name" @change="onChangeAddress($event)">
            <option value="">{{ text }}</option>
            <option v-for="item in list" :key="item" :value="JSON.stringify({ id: item.id, name: item._name })">
                {{ item._name }}
            </option>
        </select>
        <span class="bx bx-chevron-down"></span>
    </div>
</template>
<script>
export default {
    props: ['text', 'list', 'selected', 'name', 'onChangeAddress']
}
</script>