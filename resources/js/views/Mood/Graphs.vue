<template>
    <v-row>
        <v-col cols="12" md="6">
            <LineChart />
        </v-col>

        <v-col cols="12" md="6">
            <PieChart />
        </v-col>
    </v-row>
</template>

<script>
    import PieChart from '@/components/charts/PieChart';
    import LineChart from '@/components/charts/LineChart';

    export default {
        name: 'Graphs',
        components: { LineChart, PieChart },

    };
</script>
