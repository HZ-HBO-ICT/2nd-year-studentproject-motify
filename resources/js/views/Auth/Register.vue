<template>
  <div>
    <v-card>
      <v-card-title>Registreren</v-card-title>
      <v-card-text>
        <p v-if="errors.global" class="error--text" v-text="errors.global"/>

        <v-text-field
          type="text"
          label="Voornaam"
          :error-messages="errors.first_name"
          v-model="credentials.first_name"
        />

        <v-text-field
          type="text"
          label="Achternaam"
          :error-messages="errors.last_name"
          v-model="credentials.last_name"
        />

        <v-text-field
          type="email"
          label="E-mail"
          :error-messages="errors.email"
          v-model="credentials.email"
        />

        <v-text-field
          v-model="credentials.email"
          :error-messages="errors.email"
          label="E-mail"
          type="email"
        />

        <v-text-field
          v-model="credentials.password"
          :error-messages="errors.password"
          label="Wachtwoord"
          type="password"
        />

        <v-btn
          :color="getMainLightBlueColor"
          :loading="loading"
          rounded
          @click="register"
        >
          Registreren
        </v-btn>

        <a
          class="mt-5"
          href="javascript:void(0)"
          @click="$router.push({ name: 'Login' })"
          >Al geregistreerd? Klik hier</a>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
      import { mapGetters } from 'vuex';

  export default {
      name: 'Register',
      computed: mapGetters(['getMainLightBlueColor']),
      data: () => {
          return {
              loading: false,
              errors: {
                  global: null,
                  first_name: null,
                  last_name: null,
                  email: null,
                  password: null
              },
              credentials: {
                  first_name: null,
                  last_name: null,
                  email: null,
                  password: null
              }
          }
      },
      methods: {
          register() {
              this.resetErrors()

              //validate
              if (!this.credentials.first_name || !this.credentials.first_name.trim()) {
                  this.errors.first_name = 'Het voornaam veld is verplicht.'
                  return
              }

              if (!this.credentials.last_name || !this.credentials.last_name.trim()) {
                  this.errors.last_name = 'Het achternaam veld is verplicht.'
                  return
              }


              if (!this.credentials.email || !this.credentials.email.trim()) {
                  this.errors.email = 'Het e-mail veld is verplicht.'
                  return
              }

              if (!this.credentials.password || !this.credentials.password.trim()) {
                  this.errors.password = 'Het wachtwoord veld is verplicht.';
                  return;
              }

              this.loading = true

              this.$store.dispatch('register', this.credentials)
                  .then(res => this.$router.push({ name: 'Login' })
                  .catch(() => this.errors.global = 'Er kon niet geregistreerd worden.')
                  .finally(() => this.loading = false));
          },
          resetErrors() {
              this.errors = {
                  global: null,
                  first_name: null,
                  last_name: null,
                  name: null,
                  email: null,
                  password: null,
              }
          }
      }
  }
</script>

<style scoped></style>
