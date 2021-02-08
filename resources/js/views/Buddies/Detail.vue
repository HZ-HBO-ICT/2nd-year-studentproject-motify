<template>
    <v-container>
        <v-card>
            <v-card-title>Get in contact with {{name}}</v-card-title>
        </v-card>
        <v-row>
            <v-col cols="12">
                <v-row align="center" class="text-center justify-sm-space-around justify-center">
                    <v-col cols="12" lg="4">
                        <v-btn large rounded @click="getInRoomSupport" :dark="$vuetify.theme.dark"
                               :loading="isNotifyingBuddy" :light="!$vuetify.theme.dark">

                            <v-icon class="mr-2">mdi-map-marker</v-icon>
                            In-Room support
                        </v-btn>
                    </v-col>

                </v-row>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import Buddy from '@/models/Buddy'

    export default {
        name: 'BuddyOverview',
        data: function () {
            return {
                search: '',
                loading: false,
                isNotifyingBuddy: false,
                error: {title: '', message: ''},
                buddies: [],
                id: 0,
                name: ''
            }
        },
        mounted: async function () {
            this.id = this.$router.currentRoute.params.id;
            this.name = this.$router.currentRoute.params.name;
        },
        methods: {
            getInRoomSupport() {
                this.isNotifyingBuddy = true;

                axios.post(`/buddies/${this.id}/notify`, {id: this.id}).then(response => {

                    this.$router.push({name: `Buddy Confirmed`, params: {id: this.id, buddy_invite_id: response.data.buddy_invite_id}
                    })

                }).finally(_ => {
                    this.isNotifyingBuddy = false;
                })

            },
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

    .theme--dark.v-btn.v-btn--disabled:not(.v-btn--flat):not(.v-btn--text):not(.v-btn--outlined) {
        background-color: lighten(#343434, 0.5) !important;
    }
</style>
