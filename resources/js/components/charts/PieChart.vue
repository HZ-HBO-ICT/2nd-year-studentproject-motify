<template>
    <v-card>
        <div>
            <apexchart :options="options2" :series="series2" type="donut" width="380" />
        </div>
    </v-card>
</template>

<script>
    export default {
        name: 'PieChart',
        data: function() {
            return {
                series: [{
                    name: 'pie-chart',
                    data: [30, 40, 45, 50, 49, 60, 70, 91],
                }],
                options2: {},
                series2: [44, 55, 41, 17, 15],
            };
        },

    };
</script>
