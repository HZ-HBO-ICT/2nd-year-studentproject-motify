<template>
    <v-col cols="12">

        <v-card :key="buddy.id" v-for="buddy in buddies" hover @click="goToBuddyDetail(buddy)" class="mt-3" raised>
            <v-row align="center" style="width: 100%">
                <v-col style="max-width: 70px !important; margin: 0 5px">
                    <v-avatar size="50" width="50">
                        <v-img alt="Avatar" :src="buddy.avatar"/>
                    </v-avatar>
                </v-col>

                <v-col class="text-left text-truncate " style="padding: 0 !important;">
                    <strong v-text="buddy.firstName"/><br/>
                    <span class="grey--text text-sm text-truncate">Get in contact with {{buddy.firstName}}.
                    </span>
                </v-col>
                <v-col class="text-right mr-3 justify-end" style="max-width: 20px; margin-left: 10px">
                    <v-icon right>mdi-chevron-right</v-icon>
                </v-col>
            </v-row>
        </v-card>

        <error-dialog :error="error"/>

        <v-col cols="12">
            <h2 v-text="'We couldn\'t find a available buddy right now.'" class="text-center"
                v-if="!loading && !error && buddies.length < 1"/>
        </v-col>

    </v-col>
</template>

<script>

    import Buddy from '@/models/Buddy'
    import ErrorDialog from '../../components/ErrorDialog'

    export default {
        name: 'BuddyOverview',
        components: {ErrorDialog},
        data: function () {
            return {
                search: '',
                loading: false,
                error: {title: '', message: ''},
                buddies: []
            }
        },
        mounted: async function () {
            await this.fetchData()
        },

        methods: {
            fetchData: async function () {
                this.error = null
                this.loading = true

                return await axios
                    .get('/buddies')
                    .then((response) => response.data.forEach((buddy) => this.buddies.push(new Buddy(buddy))))
                    .catch((e) => (this.error = {title: 'Error', message: 'FOUTMELDING'}))
                    .finally(() => (this.loading = false))
            },
            goToBuddyDetail(buddy) {
                this.$router.push({name: 'Buddy Detail', params: {id: buddy.id, name: buddy.firstName}})
            }
        }
    }

</script>

<style lang="scss" scoped>
    .search-bar {
        position: relative;
        background-color: #e9e9e9;
        border-radius: 100px;
        width: 207px;
        height: 50px;
        margin: auto;

        input {
            margin-top: 15px;
            margin-left: 60px;
            font-size: 90%;
            outline: 0;
        }

        .button-search {
            position: absolute;
            content: '';
            width: 38px;
            height: 38px;
            right: 0;
            z-index: 2;
            background-color: #c7dafb;
            border-radius: 100px;
            color: #e9e9e9;
            padding: 5px;
            top: 5px;
            left: 8px;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            text-align: center;
        }
    }
</style>
