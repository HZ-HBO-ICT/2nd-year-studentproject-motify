<template>
    <v-card>
        <v-card-title>All given feedback</v-card-title>
        <v-simple-table>
            <template v-slot:default>
                <thead>
                <tr>
                    <th class="text-left">Name</th>
                    <th class="text-left">Feedback</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in getFeedback" :key="item.id">
                    <td>{{ item.name }}</td>
                    <td>{{ item.feedback }}</td>
                </tr>
                </tbody>
            </template>
        </v-simple-table>
    </v-card>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: 'Feedback',
        components: {},
        data() {
            return {
                loading: false,
            };
        },
        computed: mapGetters(['getFeedback']),
        created() {
            this.loading = true;

            this.$store.dispatch('fetchFeedback').finally(() => {
                this.loading = false;
            });
        },
    };
</script>
