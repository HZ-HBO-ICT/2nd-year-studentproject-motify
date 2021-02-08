<template>
    <v-container>



        <v-slide-y-transition>
            <v-row v-if="!loading">
                <v-col cols="12">
                    <v-btn :color="getMainLightBlueColor" class="ml-auto float-right" rounded small
                           @click="isScanModalOpen = true"> Snel verbinden
                    </v-btn>
                </v-col>
                <v-col v-for="room in getProjectRooms" :key="room.id" cols="12" md="3" sm="6" x-large>
                    <v-card class="mx-auto">
                        <v-img height="250"
                               src="https://freshgadgets.nl/wp-content/uploads/2020/09/philips-hue-lichtstrip-tv.jpg" />

                        <v-card-title
                        >{{ room.name }}
                            <div class="grey--text ml-auto">
                                <v-row align="center" class="mx-0">
                                    <v-rating :value="4.5" color="amber" dense half-increments readonly size="14" />

                                    <div class="grey--text ml-4">4.5</div>
                                </v-row>
                            </div>
                        </v-card-title>

                        <v-card-text>
                            <div class="grey--text">Ruimte voor {{ room.seats }} personen</div>

                            <div class="my-4 subtitle-1">
                                {{ room.description }}
                            </div>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>

        </v-slide-y-transition>

        <v-row v-show="loading" class="text-center mt-5">
            <v-col cols="12">
                <loading-indicator />
            </v-col>
        </v-row>

        <scan-project-room-code-modal :dialog="isScanModalOpen" @close="closeScanModal"
                                      @connectToProjectRoom="navigateToProjectRoom"></scan-project-room-code-modal>
    </v-container>
</template>

<script>
    import {mapGetters} from 'vuex'
    import LoadingIndicator from '@/components/LoadingIndicator'
    import ScanProjectRoomCodeModal from '@/components/ScanProjectRoomCodeModal'

    export default {
        name: 'ProjectRooms',
        components: {ScanProjectRoomCodeModal, LoadingIndicator},
        data() {
            return {
                error: {},
                loading: false,
                slot: '',
                isScanModalOpen: false
            }
        },
        computed: mapGetters(['getProjectRooms', 'getProjectRoom', 'getMainLightBlueColor']),
        created() {
            //should navigate to connected project room or not?
            this.checkRedirectConnectedProjectRoom(this.getProjectRoom)

            //fetch project rooms
            this.initProjectRooms()
        },
        methods: {
            checkRedirectConnectedProjectRoom() {
                //is empty?
                if (!Object.keys(this.getProjectRoom).length) {
                    return
                }

                const params = {id: this.getProjectRoom.id}
                this.$router.push({name: 'ProjectRoomView', params: params})
            },
            initProjectRooms() {
                this.loading = true

                this.$store
                    .dispatch('fetchProjectRooms')
                    .catch(() => {
                        this.error = 'Er is wat verkeerd gegaan'
                    })
                    .finally(() => (this.loading = false))
            },
            navigateToProjectRoom(projectRoom) {
                const params = {id: projectRoom.id}
                this.$router.push({name: 'Mood', params: params})
            },
            closeScanModal() {
                this.isScanModalOpen = false
            }
        }
    }
</script>
