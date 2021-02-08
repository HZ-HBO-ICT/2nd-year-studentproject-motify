<template>
    <v-row justify="center">
        <v-dialog
            v-model="dialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <template v-slot:activator="{ on, attrs }" />
            <v-card>
                <v-toolbar :color="getMainLightBlueColor" dark>
                    <v-btn dark icon @click="$emit('close')">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>
                        Feedback geven
                    </v-toolbar-title>

                    <v-spacer />
                </v-toolbar>

                <v-container class="mt-5">
                    <v-card-text>
                        <p class="mt-2">Wat vind je van ons product?</p>

                        <p v-if="error" class="error--text" v-text="error" />

                        <v-text-field v-model="name"
                                      label="Jouw naam*"
                        />

                        <v-textarea v-model="feedback"
                                    label="Jouw feedback*"
                        />

                        <v-btn :color="getMainLightBlueColor" :loading="loading" @click="submitFeedback" v-text="'Versturen'" />
                    </v-card-text>
                </v-container>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    import { mapGetters } from 'vuex';
    import { QrcodeCapture, QrcodeDropZone, QrcodeStream } from 'vue-qrcode-reader';

    export default {
        props: {
            dialog: null,
        },
        components: {
            QrcodeStream,
            QrcodeDropZone,
            QrcodeCapture,
        },
        name: 'ScanProjectRoomCodeModal',
        computed: {
            ...mapGetters(['getMainLightBlueColor']),
        },
        data() {
            return {
                loading: false,
                name: null,
                feedback: null,
                error: null,
            };
        },
        methods: {
            submitFeedback() {

                this.error = null;

                if (!this.name || !this.feedback) {
                    this.error = 'Er zijn verplichten velden niet ingevuld.';
                    return;
                }

                this.loading = true;

                this.$store.dispatch('storeFeedback', { name: this.name, feedback: this.feedback })
                    .then(() => {

                        //fetch all feedback again
                        this.$store.dispatch('fetchFeedback');

                        //close modal
                        this.$emit('close');
                        this.name = null;
                        this.feedback = null;

                    })
                    .catch(() => {
                        this.error = 'Sorry, er is wat misgegaan aan onze kant :(';
                    })
                    .finally(() => {
                        this.loading = false;

                    });
            },

        },
    };
</script>
