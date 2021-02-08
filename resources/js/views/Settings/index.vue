<template xmlns="http://www.w3.org/1999/html">
    <v-container fluid>
        <v-card class="mx-auto">
            <v-list subheader three-line>
                <v-subheader v-text="'General'" />

                <v-list-item>
                    <template v-slot:default="{ dark_theme }">
                        <v-list-item-action class="my-auto">
                            <theme-switch class="mx-3" />
                        </v-list-item-action>

                        <v-list-item-content>
                            <v-list-item-title v-text="'Dark Theme'" />
                            <v-list-item-subtitle v-text="'Make the view in a dark shade, can be helpful in the evening.'" />
                        </v-list-item-content>
                    </template>
                </v-list-item>

                <v-list-item>
                    <template>
                        <v-list-item-action class="my-auto">
                            <v-btn color="error" outlined @click="resetHue" v-text="'[X]'" />
                        </v-list-item-action>

                        <v-list-item-content>
                            <v-list-item-title class="error--text"> Reset Hue settings </v-list-item-title>
                            <v-list-item-subtitle> Remove all the Hue details and get new ones by logging in. </v-list-item-subtitle>

                        </v-list-item-content>
                    </template>
                </v-list-item>
            </v-list>
        </v-card>

        <v-card class="mx-auto mt-5">
            <v-list subheader three-line>
                <v-subheader v-text="'Account'" />
                <router-link :to="'/graphs'">
                    <v-list-item>
                        <template>
                            <v-list-item-action class="my-auto">
                                <v-icon class="mx-3" large v-text="'mdi-chart-bar'" />
                            </v-list-item-action>

                            <v-list-item-content>
                                <v-list-item-title v-text="'Mood statistics'" />
                                <v-list-item-subtitle v-text="'An overview of your daily moods and feelings.'" />
                            </v-list-item-content>

                        </template>
                    </v-list-item>
                </router-link>

                <v-list-item>
                    <template>
                        <v-btn v-if="Object.keys($auth.user()).length" key="logout" block color="error" @click="logout">
                            <v-icon small> mdi-logout</v-icon>
                            <span>Sign out </span>
                        </v-btn>
                    </template>
                </v-list-item>
            </v-list>
        </v-card>
    </v-container>
</template>

<script>
    import ThemeSwitch from '@/components/ThemeSwitch';

    export default {
        name: 'Settings',
        components: { ThemeSwitch },
        methods: {
            resetHue: function() {
                const confirmed = window.confirm('Are you sure you want to reinstall the Hue module?');
                if (confirmed) window.open('/hue/auth');
            },
            logout: async function() {
                return await this.$auth.logout(this.$auth.logoutData);
            },
        },
    };
</script>

<style lang="scss" scoped></style>
