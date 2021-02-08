<template>
    <v-app-bar :clipped-left="$vuetify.breakpoint.lgAndUp" :color="getMainLightBlueColor" app class="header-bg">
        <theme-switch class="d-none" />
    </v-app-bar>
</template>

<script>
    import { mapGetters } from 'vuex';
    import ThemeSwitch from './ThemeSwitch';

    export default {
        name: 'AppHeader',
        components: { ThemeSwitch },
        computed: mapGetters(['getMainLightBlueColor']),
        data() {
            return {
                bridge: null,
            };
        },
    };
</script>

<style lang="scss">
    .v-application.theme--dark.v-application {
        .logo {
            color: #000000;
            font-family: Martel Sans, serif;
            font-style: normal;
            font-weight: 200;
            left: -4px;
            position: absolute;
            text-align: center;
            text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            top: 62px;
            width: 100%;
            z-index: 9;
            svg {
                height: 118px;
                padding: 30px 20px;
                text-align: center;
                width: 100%;
            }

            &-bg {
                background: linear-gradient(#ffffff 20%, rgba(225, 225, 225, 1) 80%);
                border-radius: 0 0 75px 0;
                height: 226px;
                left: -1px;
                position: absolute;
                top: 0;
                width: 100%;
            }

            &-footer {
                background: #e3e3e3;
                border-top-left-radius: 48px;
                height: 70px;
                margin-top: 226px;
                position: relative;
                width: 70px;

                &::before {
                    background: #e3e3e3;
                    bottom: auto;
                    content: ' ';
                    height: 60px;
                    left: 0;
                    position: absolute;
                    top: 0;
                    width: 60px;
                }

                &::after {
                    border: 40px #9bbdfd solid;
                    border-top-left-radius: 100%;
                    content: '';
                    height: 100%;
                    position: absolute;
                    top: 0;
                    width: 100%;
                }
            }
        }
    }

    .v-application.theme--light.v-application {
        .logo {
            color: #000000;
            font-family: Martel Sans, serif;
            font-size: 64px;
            font-style: normal;
            font-weight: 200;

            height: 118px;
            left: -4px;
            line-height: 117px;
            position: absolute;
            text-align: center;
            text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);

            top: 62px;
            width: 292px;
            z-index: 9;

            &-bg {
                background: linear-gradient(156.15deg, #a2c1fa 20%, rgb(255, 255, 255) 80%);
                border-radius: 0 0 75px 0;
                height: 226px;
                left: -1px;
                position: absolute;
                top: 0;
                width: 100%;
            }

            &-footer {
                background: #c7dafb;
                border-top-left-radius: 48px;
                height: 70px;
                margin-top: 226px;
                position: relative;
                width: 70px;

                &::before {
                    background: #c7dafb;
                    bottom: auto;
                    content: ' ';
                    height: 60px;
                    left: 0;
                    position: absolute;
                    top: 0;
                    width: 60px;
                }

                &::after {
                    border: 40px rgb(225, 225, 225) solid !important;
                    border-top-left-radius: 100%;
                    content: '';
                    height: 100%;
                    position: absolute;
                    top: 0;
                    width: 100%;
                }
            }
        }
    }
</style>
