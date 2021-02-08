<template>
    <section>


        <!--        Loading indicator -->
        <v-row v-show="loading" class="text-center">
            <v-col cols="12">
                <loading-indicator/>
            </v-col>
        </v-row>

        <!--        Error message-->
<!--        <ErrorDialog :error="error" :loading="loading"/>-->

        <v-slide-y-transition>

            <div v-if="!error && !loading" class="mx-auto">
                <v-img height="250"
                       src="https://freshgadgets.nl/wp-content/uploads/2020/09/philips-hue-lichtstrip-tv.jpg"/>

                <v-btn class="ml-auto mt-4 float-right" color="success" readonly rounded small> Connected</v-btn>

                <v-card-title
                >{{ getProjectRoom.name }}

                    <div class="grey--text ml-auto">
                        <v-row align="center" class="mx-0">
                            <v-rating :value="4.5" color="amber" dense half-increments readonly size="14"/>

                            <div class="grey--text">4.5</div>
                        </v-row>
                    </div>
                </v-card-title>

                <v-card-text>
                    <div class="grey--text">Ruimte voor {{ getProjectRoom.seats }} personen</div>

                    <div class="my-4 subtitle-1">
                        {{ getProjectRoom.description }}
                    </div>
                </v-card-text>

                <v-divider class="mx-4"/>

                <v-btn color="green darken-1" text @click="isChangeColorDialogOpen = true"> Handmatig lichtkleur
                    veranderen
                </v-btn>

                <v-card-actions>
                    <v-btn class="my-3 ml-auto" rounded @click="giveFeedback"> Disconnect</v-btn>
                </v-card-actions>
            </div>
        </v-slide-y-transition>

        <change-color-modal :dialog="isChangeColorDialogOpen" @close="closeChangeColorModal"></change-color-modal>

        <give-feedback :dialog="isGiveFeedbackDialogOpen" @close="closeFeedbackModal"></give-feedback>
    </section>
</template>

<script>
    import LoadingIndicator from '@/components/LoadingIndicator';
    import ChangeColorModal from '@/components/ChangeColorModal';
    import ErrorDialog from '@/components/ErrorDialog';
    import GiveFeedback from '@/components/GiveFeedback';
    import {mapGetters} from 'vuex';
    import componentWithDynamicModule from '../../utils/dynamic-store-module/componentWithDynamicModule';

    export default {
        name: 'ProjectRoomView',
        components: {ErrorDialog, ChangeColorModal, LoadingIndicator, GiveFeedback},
        extends: componentWithDynamicModule('groups'),
        data() {
            return {
                projectRoomId: this.$route.params.id,
                refresh: null,
                loading: false,
                error: null,
                isChangeColorDialogOpen: false,
                isGiveFeedbackDialogOpen: false,
            };
        },
        async created() {
            await this.$store.dispatch(`groups/initialize`, 'groups');
        },
        computed: {
            ...mapGetters(['getProjectRoom']),
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

        disconnect() {
            //disconnect
            this.$store.dispatch('disconnectFromProjectRoom').then(() => this.$router.push({path: '/book'}));
        },

        methods: {
            initProjectRoom() {
                this.loading = true;

                //fetch
                this.$store
                    .dispatch('fetchProjectRoom', this.projectRoomId)
                    .catch(() => {
                        this.error = 'Het is niet gelukt om de projectruimte op te halen';
                    })
                    .finally(() => (this.loading = false));
            },
            giveFeedback() {
                this.isGiveFeedbackDialogOpen = true;
                this.$router.push({path: '/book'});
            },
            closeChangeColorModal() {
                this.isChangeColorDialogOpen = !this.isChangeColorDialogOpen;
            },
            closeFeedbackModal() {
                this.isGiveFeedbackDialogOpen = false;
                this.forceDisconnect();
            },
            changeColorPicker() {
                //use watch instead of method @change
                console.log(this.colorPicker);
                console.log(this.colorPicker['rgba']);
            },
        },
    };
</script>
