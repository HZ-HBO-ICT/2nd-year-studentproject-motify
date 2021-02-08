<template>
    <v-container>
        <v-row align="center" class="text-center justify-sm-space-around justify-center">
            <v-col cols="12 mb-5 pb-5">
                <v-avatar>
                    <img
                        widht="150"
                        :src="buddy.avatar"
                        :alt="buddy.first_name"
                    >
                </v-avatar>
                <p class="mt-4 h5">{{buddy.first_name}} is op de hoogte gebracht van je verzoek. Wanneer het verzoek is
                    geaccepteerd, ontvang je een e-mail.</p>
            </v-col>
            <v-btn elevation="6" class="mt-4" rounded @click="goBack"
                   :dark="!$vuetify.theme.dark" :light="$vuetify.theme.dark"
            >Terug
            </v-btn
            >

        </v-row>
    </v-container>
</template>

<script>

    export default {
        name: 'Confirmed',
        data: function () {
            return {
                loaders: [
                    {
                        id: 1,
                        loading: false
                    }
                ],
                error: {title: '', message: ''},
                buddy: {},
                id: this.$route.params.id
            }
        },
        mounted: async function () {
            axios.get(`/buddies/${this.id}`).then(response => {
                this.buddy = response.data
            });
        },
        methods: {
            goBack() {
                this.$router.push({path: '/'})
            }
        }
    }
</script>

<style lang="scss" scoped>
    .view-recent-card {
        max-width: 335px;
        max-height: 350px;
        margin: 0 auto;
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 25px;
    }

    h2 {
        display: block;
        color: #373737;
    }

    h3 {
        color: #373737;
    }
</style>
