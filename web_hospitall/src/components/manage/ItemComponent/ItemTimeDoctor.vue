<template>
    <div class="select-list">
        <div v-for="item in list" @click="handleClick(item)" :key="item.id" class="item-select" :class="([...currentData].findIndex(dt => dt.day === item.day && dt.month === item.month &&
        dt.year)) === -1 ? '' : 'active'">
            {{ item.name }}
        </div>
    </div>
</template>
<script>

export default {
    props: ['setCurrent', 'id', 'currentData'],
    data() {
        return {
            list: []
        }
    },
    methods: {
        handleClick: function (item) {
            const index = [...this.currentData].findIndex(dt => dt.day === item.day && dt.month === item.month &&
                dt.year === item.year);
            if (index !== -1) {
                let clone = [...this.currentData];
                clone.splice(index, 1);
                this.setCurrent(clone);
            }
            else {
                this.setCurrent([...this.currentData, item]);
            }
        }
    },
    mounted() {
        (() => {
            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            let dayofweek = date.getDay();
            let listData = [];
            for (let index = 0; index < 15; index++) {
                listData.push({
                    id: index + 1,
                    day: day,
                    month,
                    dayofweek,
                    year,
                    name: `${dayofweek === 0 ? 'Chủ nhật' : `Thứ ${dayofweek + 1}`} - ${day < 10 ? `0${day}` : day}/${month < 10 ? `0${month}` : month}`
                })
                dayofweek = (dayofweek === 6 ? 0 : dayofweek + 1);
                day++;
                let too = false;
                if (month === 1 || month === 3 || month === 5 || month === 7 || month === 8 || month === 10 || month === 12) {
                    if (day > 31) {
                        too = true;
                    }
                }
                if (month === 4 || month === 6 || month === 9 || month === 11) {
                    if (day > 30) {
                        too = true;
                    }
                }
                if (month === 2) {
                    if (year % 4 === 0) {
                        if (day > 29) {
                            too = true;
                        }
                    }
                    else {
                        if (day > 28) {
                            too = true;
                        }
                    }
                }
                if (too) {
                    day = 1;
                    if (month === 12) {
                        month = 1;
                        year++;
                    }
                    else {
                        month++;
                    }
                }
            }
            this.list = listData;
        })();
    }
}
</script>