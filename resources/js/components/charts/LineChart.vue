<template>
    <div>
        <apexchart ref="apexChart" type="line" :options="chartOptions" :series="chartSeries"></apexchart>
    </div>
</template>

<script>
import VueApexCharts from 'vue3-apexcharts';

export default {
    components: {
        apexchart: VueApexCharts
    },
    data() {
        return {
            chartOptions: {
                xaxis: {
                    categories: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio']
                }
            },
            chartSeries: [
                {
                    name: 'Cliques',
                    data: [65, 59, 80, 81, 56]
                }
            ]
        };
    },
    mounted() {
        this.updateChart();
    },
    methods: {
        updateChart() {
            if (this.$refs.apexChart) {
                // this.$refs.apexChart.updateOptions(this.chartOptions);
                // this.$refs.apexChart.updateSeries(this.chartSeries);
            }
        }
    }
};
</script>
