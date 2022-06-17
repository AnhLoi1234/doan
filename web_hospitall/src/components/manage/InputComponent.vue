<template>
    <div class="order__form--input">
        <span v-if="icon" :class="icon"></span>
        <input v-if="!disabled" :type="type" :placeholder="placeholder" :name="name" @input="onChange($event)"
            :value="value">
        <input v-else :type="type" :placeholder="placeholder" :name="name" @input="onChange($event)" :value="value"
            disabled class="disabled">
        <span v-if="type === 'password'" class="bx bx-hidden"></span>
    </div>
    <p class="color-red" :class="errorMessage ? 'active' : ''">{{ errorMessage }}</p>
</template>
<script>
export default {
    props: ['errorMessage', 'icon', 'placeholder', 'type', 'name', 'onChange', 'value', 'disabled']
}
</script>