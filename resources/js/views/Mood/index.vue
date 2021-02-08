<template>
    <v-container class="mx-2">
        <h2>How are you feeling today?</h2>
        <v-row>
            <v-col v-for="(item, index) in moodArray" :key="item.id" class="d-flex flex-column justify-center" cols="4" md="2" sm="2">
                <v-btn :dark="$vuetify.theme.dark" :light="!$vuetify.theme.dark" class="d-block mx-auto mt-lg-5" height="80px" rounded width="80px" @click="selectMood(item.id, item.points)">
                    <v-img :src="'../img/emoji/'+index+'.png'" class="d-block" max-height="78" max-width="78" />
                </v-btn>
                <span class="d-block text-center small" v-text="item.title" />
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        name: 'Mood',
        data() {
            return {
                params: { id: this.$router.currentRoute.params.id },
                moodArray: [
                    {
                        id: 1,
                        title: 'happy',
                        points: 0,
                    },
                    {
                        id: 2,
                        title: 'excited',
                        points: 10,
                    },
                    {
                        id: 3,
                        title: 'grateful',
                        points: 10,
                    },
                    {
                        id: 4,
                        title: 'good',
                        points: 7,
                    },
                    {
                        id: 5,
                        title: 'worried',
                    },
                    {
                        id: 6,
                        title: 'unsure',
                        points: 4,
                    },
                    {
                        id: 7,
                        title: 'tired',
                        points: 3,
                    },
                    {
                        id: 8,
                        title: 'stressed',
                        points: 2,
                    },
                    {
                        id: 9,
                        title: 'lonely',
                        points: 1,
                    },
                    {
                        id: 10,
                        title: 'anxious',
                        points: 5,
                    },
                    {
                        id: 11,
                        title: 'angry',
                        points: 11,
                    },
                    {
                        id: 12,
                        title: 'sad',
                        points: 12,
                    },
                ],
            };
        },
        methods: {
            /**
             * Check the selected mood and transfer points directly to the database
             *
             * @param   { Number }      id
             * @param   { Number }      points
             * @returns { Promise<boolean> }
             */
            selectMood(id, points) {
                const params = { id: this.$router.currentRoute.params.id };

                this.$router.push({ name: 'Optimization', params: params });
            },
        },
    };
</script>

<style lang="scss" scoped>
    .v-btn--rounded {
        border-radius: 100% !important;
    }

    span {
        margin-top: 15px;
        color: #000 !important;
    }
</style>
