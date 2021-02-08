<template>
    <v-row justify="center">
        <v-dialog
            v-model="dialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <template v-slot:activator="{ on, attrs }"></template>
            <v-card class="relative">
                <div class="overlay"> <v-toolbar :color="getMainLightBlueColor" dark>
                    <v-btn dark icon @click="$emit('close')">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title v-text="'Change lignt color'" />
                    <v-spacer />
                </v-toolbar></div>
                <v-color-picker
                    v-model="colorPicker"
                    class="my-auto mx-auto mt-15"
                    disabled
                    hide-canvas
                    hide-inputs
                    hide-mode-switch
                    show-swatches
                    swatches-max-height="100%"
                    width="80%"

                />
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        props: {
            dialog: null,
        },
        data: () => {
            return {
                colorPicker: null,
                refresh: null,
            };
        },
        name: 'ChangeColorModal',
        computed: {
            ...mapGetters({getMainLightBlueColor: 'getMainLightBlueColor'}),
            room: {
                get() {
                    const toInt = parseInt(1);
                    return this.$store.getters['groups/getByID'](toInt);
                },
                set() {
                    return console.log('[LOG]: method not provided yet');
                },
            },
        },
        mounted() {
            this.refresh = setInterval(
                () => this.$store.dispatch(`groups/fetch`, 'groups'),
                500000,
            );
        },
        watch: {
            colorPicker: function(val) {
                let rgba = val['rgba'];

                rgba = { red: rgba.r, green: rgba.g, blue: rgba.b };
                this.$store.dispatch('changeColorOfLights', rgba);
            },
        },
    };
</script>

<style lang="scss" scoped>
    .relative{
        position: relative;
    }
    .overlay{
        position: absolute;
        background: black;
        right: 0;
        left:0;
        top: 80px;
        height: 120px;
        z-index: 999;
        width: 100%;

    }
    .v-color-picker__color {
    max-height: 50px !important;
        height: 50px!important;

    }

    </style>
