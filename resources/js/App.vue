<template id="app">
    <v-app>
        <div class="logo-bg">
            <div class="logo-footer"/>
        </div>

        <div class="logo" style="font-size: 32px !important">
        {{ $router.currentRoute.name }}
        </div>

        <v-main lass="mt-5">

            <AppHeader/>
            <v-container fluid>
                <router-view/>
            </v-container>
        </v-main>

        <AppFooter :key="componentKey"/>
    </v-app>
</template>

<script>

    import router from '@/router'
    import NetworkAlert from '@/components/NetworkAlert'


    import {mapState} from 'vuex'
    import AppFooter from './components/AppFooter';


    export default {
        name: 'App',
        components: {
            NetworkAlert,
            AppHeader: () => import('@/components/AppHeader'),
            AppFooter: () => import('@/components/AppFooter')
        },
        data() {
            return {
                routes: router.routes,
                router: router,
                componentKey: 0
            }
        },
        watch: {
            $route: function (newValue, oldValue) {
                if (!oldValue.meta.auth || !newValue.meta.auth)
                    this.componentKey += 1;
            },
        }
    }

</script>

<style lang="scss" scoped>
    .v-application a {
        color: white !important;
        text-decoration: white;
        text-transform: none;
    }

    .v-main {
        margin-top: 180px;
    }

    .v-container {
        & h2 {
            font-family: Martel Sans, serif !important;
            font-style: normal !important;
            font-weight: 300 !important;
            font-size: 18px !important;
            line-height: 33px !important;

            letter-spacing: 0.05em !important;
        }
    }

    .small {
        font-size: 90% !important;
        font-weight: bolder !important;
    }

    .v-application.theme--dark.v-application {
        //below blue with grey
        background: linear-gradient(#9bbdfd 28%, rgba(255, 255, 255, 0.85) 80%) !important;
    }

    .v-application.theme--light.v-application {
        background: rgb(225, 225, 225) !important;
    }

    .v-sheet {
        border: unset;
        box-shadow: none;
        color: rgba(0, 0, 0, 0.87);
    }

    .header-bg {
        background: none !important;
        box-shadow: none !important;
        padding-top: var(--sat) !important;
    }

    h3 {
        color: white !important;
    }

    .v-card {
        background: linear-gradient(0deg, var(-color()), #ffffff), #777777;
        border-radius: 25px !important;
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25) !important;
    }

    .logo-footer {
        z-index: -1 !important;
    }

    .logo {
        font-size: 22px !important;
    }
</style>
