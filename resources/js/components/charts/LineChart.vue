<template>
    <div>
        <apexchart type="line" :options="chartOptions" :series="chartSeries"></apexchart>
    </div>
</template>

<script>
import VueApexCharts from 'vue3-apexcharts';

export default {
    components: {
        apexchart: VueApexCharts
    },
    props: {
        data: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            chartOptions: {
                xaxis: {
                    categories: this.data.map(item => item.date)
                }
            },
            chartSeries: [
                {
                    name: 'Cliques',
                    data: this.data.map(item => item.count)
                }
            ]
        };
    }
};
</script>
