<template>
    <v-content>
        <v-expand-transition>
            <v-card v-if="loader" :key="!loader">
                <v-card-title v-if="loader">De gegevens worden ingeladen.</v-card-title>
            </v-card>
        </v-expand-transition>
        <v-expand-transition>
            <v-card v-if="!loader && state === 'success'" :key="loader">
                <v-card-title>De Hue gegevens zijn succesvol aangepast.</v-card-title>
                <v-card-text
                >Verbonden met <strong v-text="bridge.name" /> deze bevindt zich op zigbee-kanaal
                    <v-chip v-text="bridge.zigbeechannel" />
                </v-card-text>

                <v-card-text>Er zijn momenteel <strong>2</strong> projectruimten in gebruik</v-card-text>
            </v-card>
            <error-dialog v-if="!loader && state === 'error'" :key="!loader && error" :error="error" :loading="loader" />
        </v-expand-transition>

        <v-overlay :key="show & loader" :value="overlay" style="text-align: center">
            <v-progress-circular v-show="state && loader" indeterminate size="64" />
            <v-scale-transition>
                <v-icon
                    v-if="state && show"
                    :key="loader"
                    dark
                    right
                    style="font-size: 70px !important"
                    x-large
                    v-text="state === 'success' && !loader ? 'mdi-checkbox-marked-circle' : 'mdi-close-circle-outline'"
                />
            </v-scale-transition>
            <p v-if="loader" :key="loader" style="margin-top: 30px">De gegevens worden toegepast, dit kan enkele seconden duren...</p>
        </v-overlay>
    </v-content>
</template>

<script>
    import ErrorDialog from '@/components/ErrorDialog';
    import { Bridge } from '@/models/Bridge';

    export default {
        name: 'Callback',
        components: { ErrorDialog },
        data() {
            return {
                overlay: true,
                state: this.$route.params.state,
                show: false,
                loader: true,
                bridge: Bridge,
                error: null,
            };
        },
        async mounted() {
            setTimeout(async () => {
                if (this.state === 'success') await this.getBridgeDetails();

                this.show = true;
                this.loader = false;

                if (this.state === 'error') this.error = 'Er is iets verkeerd gegaan, Probeer het over een paar minuten nog eens.';
                setTimeout(() => (this.overlay = false), 1500);
            }, 3500);
        },
        methods: {
            async getBridgeDetails() {
                axios.get('hue/bridge').then((response) => (this.bridge = new Bridge(response.data)));
            },
        },
    };
</script>
