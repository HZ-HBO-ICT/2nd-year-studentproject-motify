<template>
    <v-card>
        <div>
            <apexchart :options="options" :series="series" type="bar" width="100%" />
        </div>
    </v-card>
</template>

<script>
    export default {
        name: 'LineChart',
        data: function() {
            return {
                options: {
                    colors: ['#F44336', '#E91E63', '#9C27B0'],
                    chart: {
                        id: 'line-chart',
                    },
                    xaxis: {
                        categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
                    },
                },
                series: [{
                    name: 'series-1',
                    data: [30, 40, 45, 50, 49, 60, 70, 91],
                }],
            };
        },
    };
</script>
