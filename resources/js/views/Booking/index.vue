<template>
    <v-content>
        <v-card>
            <v-card-title>Book a room</v-card-title>
            <v-card-text></v-card-text>
        </v-card>

        <v-btn :disabled="loading" :loading="loading" class="ma-2" elevation="5" href="/optimize" x-large @click="loader = 'loading'">Start room optimization</v-btn>
    </v-content>
</template>

<script>
    export default {
        name: 'Book a room',
        components: {},
        data() {
            return {
                loader: null,
                loading: false,
            };
        },
        // Loading component for button
        watch: {
            loader() {
                const l = this.loader;
                this[l] = !this[l];

                setTimeout(() => (this[l] = false), 3000);

                this.loader = null;
            },
        },
    };
</script>
