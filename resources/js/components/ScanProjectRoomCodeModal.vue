<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <qrcode-stream v-if="!connecting" :camera="camera" @decode="onDecode" @init="onInit">
                <div class="d-flex flex-grow-1 flex-column h-100 justify-space-between">
                    <div>
                        <div class="camera-row">
                            <div class="camera-row-icon pt-3">
                                <v-btn v-if="!loading" icon @click="$emit('close')">
                                    <m-icon :name="'chevron'" />
                                </v-btn>
                            </div>
                            <span class="d-block my-auto pt-2">
                                <router-link to="/">
                                    <v-img
                                        :src="'../img/icons/android-chrome-48x48.png'"
                                        class="shrink elevation-7"
                                        contain
                                        eager
                                        height="40"
                                        style="border-radius: 10px"
                                        transition="scale-transition"
                                        width="40"
                                    />
                                </router-link>
                            </span>
                            <div class="camera-row-icon pt-3">
                                <v-btn v-if="!loading && !noFrontCamera" class="my-auto" icon @click="switchCamera">
                                    <m-icon :name="'camera-switch'" />
                                </v-btn>
                                <v-btn v-else-if="(noFrontCamera && noRearCamera) || loading" class="text-white-50 my-auto" icon>
                                    <m-icon :name="'camera-switch'" />
                                </v-btn>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="camera-row">
                            <div class="camera-row-icon">
                                <v-btn v-if="!loading" icon @click="$router.push({ path: '/settings' })">
                                    <m-icon :name="'settings'" />
                                </v-btn>
                            </div>
                            <div v-if="!loading" class="camera-button camera-footer-item"></div>
                            <div class="camera-row-icon">
                                <v-btn v-if="!loading" icon @click.prevent="connectWithDevRoom">
                                    <m-icon :name="'images'" />
                                </v-btn>
                            </div>
                        </div>
                    </div>
                </div>
            </qrcode-stream>

            <v-progress-circular v-if="loading || connecting" :color="getMainLightBlueColor" :size="40" :width="4" class="mx-auto relative d-block mt-5" indeterminate />
        </v-dialog>
    </v-row>
</template>

<script>
    import { QrcodeCapture, QrcodeDropZone, QrcodeStream } from 'vue-qrcode-reader';
    import { mapGetters } from 'vuex';
    import MIcon from './MIcon';

    export default {
        props: {
            dialog: null,
        },
        components: {
            MIcon,
            QrcodeStream,
            QrcodeDropZone,
            QrcodeCapture,
        },
        name: 'ScanProjectRoomCodeModal',
        computed: mapGetters(['getMainLightBlueColor', 'getProjectRoom']),
        data() {
            return {
                camera: 'rear',
                noRearCamera: false,
                noFrontCamera: false,
                loading: false,
                connecting: false,
                error: null,
            };
        },
        methods: {
            onDecode(decodedString) {
                if (decodedString) {
                    this.connect(decodedString);
                }
            },
            async onInit(promise) {
                this.loading = true;
                try {
                    await promise;
                } catch (error) {
                    const triedFrontCamera = this.camera === 'front';
                    const triedRearCamera = this.camera === 'rear';
                    const cameraMissingError = error.name === 'OverconstrainedError';
                    if (triedRearCamera && cameraMissingError) {
                        this.noRearCamera = true;
                    }
                    if (triedFrontCamera && cameraMissingError) {
                        this.noFrontCamera = true;
                    }
                } finally {
                    this.loading = false;
                }
            },
            switchCamera() {
                switch (this.camera) {
                    case 'front':
                        this.camera = 'rear';
                        break;
                    case 'rear':
                        this.camera = 'front';
                        break;
                }
            },
            connect(code) {
                this.error = null;
                this.connecting = true;
                this.$store
                    .dispatch('connectToProjectRoom', code)
                    .then((response) => {
                        const projectRoom = response.data;
                        this.$emit('connectToProjectRoom', projectRoom);
                    })
                    .catch((error) => {
                        console.log(error);
                        const status = error.response.status;
                        if (status === 404) {
                            this.error = 'Geen geldige projectruimte';
                        } else {
                            this.error = 'Sorry, er is wat misgegaan. Herstart de applicatie.';
                        }
                    })
                    .finally(() => {
                        this.connecting = false;
                    });
            },
            connectWithDevRoom: function() {
                return this.$router.push({ name: 'Mood', params: { id: 4 } });
            },
        },
    };
</script>

<style lang="scss" scoped>
    .h-100 {
        height: 100% !important;
        max-height: 100% !important;
    }

    .justify-space-between {
        justify-content: space-between !important;
    }

    .qrcode-stream-wrapper {
        position: absolute;
        display: block;
        flex-direction: row;
        background-color: #000000;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .camera {
        &-row {
            display: flex;
            flex: 1;
            width: 100%;
            justify-content: space-between;

            &-icon {
                z-index: 99;
                height: 50px;
                width: 50px;

                text-shadow: 0 3px 6px rgba(0, 0, 0, 0.6), 0 3px 6px rgba(0, 0, 0, 0.65);

                .camera-button {
                    background: white;
                    border: none;
                    border-radius: 100%;
                    color: var(--color-step-850);
                    max-width: 50px;
                    min-width: 50px;
                    position: relative;

                    &.capture {
                        &::after {
                            border: 2.5px solid black;
                            border-radius: 100%;
                            bottom: 3px;
                            content: '\21BB';
                            font-size: 40px;
                            left: 3px;
                            line-height: 35px;
                            position: absolute;
                            right: 3px;
                            top: 3px;
                            transition: 0.3s;
                        }
                    }

                    &::after {
                        border: 2.5px solid black;
                        border-radius: 100%;
                        bottom: 3px;
                        content: '';
                        left: 3px;
                        position: absolute;
                        right: 3px;
                        top: 3px;
                        transition: 0.3s;
                    }

                    &:active {
                        &::after {
                            border: 4px solid var(--text-color);
                            border-radius: 100%;
                            bottom: 3px;
                            content: '';
                            left: 3px;
                            position: absolute;
                            right: 3px;
                            top: 3px;
                            transition: 0.3s;
                        }
                    }
                }
            }

            padding: calc(5px + var(--sal)) calc(25px + var(--sar)) calc(20px + var(--sab)) calc(25px + var(--sal));
        }

        &-button {
            background: white;
            border: none;
            border-radius: 100%;
            color: var(--color-step-850);
            max-width: 50px;
            min-width: 50px;
            position: relative;

            &.capture {
                &::after {
                    border: 2.5px solid black;
                    border-radius: 100%;
                    bottom: 3px;
                    content: '\21BB';
                    font-size: 40px;
                    left: 3px;
                    line-height: 35px;
                    position: absolute;
                    right: 3px;
                    top: 3px;
                    transition: 0.3s;
                }
            }

            &::after {
                border: 2.5px solid black;
                border-radius: 100%;
                bottom: 3px;
                content: '';
                left: 3px;
                position: absolute;
                right: 3px;
                top: 3px;
                transition: 0.3s;
            }

            &:active {
                &::after {
                    border: 4px solid var(--text-color);
                    border-radius: 100%;
                    bottom: 3px;
                    content: '';
                    left: 3px;
                    position: absolute;
                    right: 3px;
                    top: 3px;
                    transition: 0.3s;
                }
            }
        }
    }
</style>
