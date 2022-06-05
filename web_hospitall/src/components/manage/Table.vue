<template>
    <div v-if="!loading" class="dashboard__content">
        <p>{{ title }}</p>
        <table>
            <tr v-if="hideCrud">
                <th>STT</th>
                <th v-for="h in heading" :key="h">{{ h }}</th>
            </tr>
            <tr v-else>
                <th>STT</th>
                <th v-for="h in heading" :key="h">{{ h }}</th>
                <th>Sửa</th>
                <th>Xoá</th>
            </tr>
            <template v-if="!loading && list?.length > 0">
                <slot></slot>
            </template>
            <template v-else>
                <tr>
                    <td colspan="10" style="border: none;">
                        <div class="loading__content">
                            Không có kết quả.
                        </div>
                    </td>
                </tr>
            </template>
        </table>
    </div>
    <div v-else class="loading__content">
        <span class='bx bx-loader-alt loading'></span>
    </div>
</template>
<script>
export default {
    props: ['title', 'heading', 'list', 'loading', 'length', 'hideCrud'],
}
</script>