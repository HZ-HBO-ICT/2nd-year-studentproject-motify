<template>
    <div>
        <v-card>
            <v-card-title>Inloggen</v-card-title>
            <v-card-text>
                <p v-if="errors.global" class="error--text">{{ errors.global }}</p>

                <v-text-field v-model="credentials.email"
                              :error-messages="errors.email"
                              label="E-mail"
                              type="email" />

                <v-text-field v-model="credentials.password"
                              :error-messages="errors.password"
                              label="Wachtwoord"
                              type="password" />

                <v-btn :color="getMainLightBlueColor" :loading="loading" rounded @click="login">
                    Inloggen
                </v-btn>

                <a class="mt-5" href="javascript:void(0)" @click="$router.push({name: 'Register'})">Nog niet geregistreerd? Klik hier</a>

            </v-card-text>
        </v-card>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: 'Login',
        computed: mapGetters([
            'getMainLightBlueColor',
        ]),
        data: () => {
            return {
                loading: false,
                errors: {
                    global: null,
                    email: null,
                    password: null,
                },
                credentials: {
                    email: null,
                    password: null,
                },
            };
        },
        methods: {
            login() {
                this.resetErrors();

                //validate
                if (!this.credentials.email || !this.credentials.email.trim()) {
                    this.errors.email = 'Het e-mail veld is verplicht.';
                    return;
                }

                if (!this.credentials.password || !this.credentials.password.trim()) {
                    this.errors.password = 'Het wachtwoord veld is verplicht.';
                    return;
                }

            this.loading = true

            this.$auth.login(
                {
                    data: this.credentials,
                    success: function(res) {
                        this.loading = false;
                    },
                    error: function(error) {
                        this.loading = false;
                        this.errors.global = error.response.data.error;
                    },

                }, this.$auth.loginData);
            },
            resetErrors() {
                this.errors = {
                    global: null,
                    email: null,
                    password: null,
                };
            },

        },
    };
</script>

<style scoped></style>
