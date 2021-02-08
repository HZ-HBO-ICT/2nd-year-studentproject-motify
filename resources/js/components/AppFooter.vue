<template>
  <v-bottom-navigation :color="getMainLightBlueColor" :key="links.length" fixed grow>
    <v-btn
      v-for="(route, i) in links"
      :key="i"
      :to="route.path"
      v-if="route.meta.inFooter"
    >
      <span v-text="route.name" />
      <v-badge v-if="route.meta.notify" bordered color="red" dot right>
        <v-icon v-text="route.meta.icon" />
      </v-badge>
      <v-icon v-else v-text="route.meta.icon" />
    </v-btn>
  </v-bottom-navigation>
</template>

<script>

  import routes from '../router/routes';

  export default {
    name: 'AppFooter',
    computed: {
      getMainLightBlueColor() {
        return this.$store.getters.getMainLightBlueColor;
      },
    },
    data() {
      return {
        links: [],
      };
    },
    mounted: async function () {
        let authenticated = false;
        if(localStorage.getItem('default_auth_token'))
             authenticated  = true

        routes.forEach(route =>{
            if(!route.meta && !route.meta.auth)
                this.links.push(route)
            else if(!(route.meta.auth
                === false) && authenticated)
                this.links.push(route);
            else if(!route.meta.auth === true && !authenticated)
                this.links.push(route);
        })

    },
    methods: {
      logout() {
        this.$auth.logout(this.$auth.logoutData);
      },
    },
  };
</script>
