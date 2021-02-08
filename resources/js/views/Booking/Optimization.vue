<template>
    <v-container>
        <h2>What do you need today?</h2>

        <v-col class="py-2" cols="12">
            <v-btn class="ma-2" color="red lighten-2 black--text" elevation="3" value="power" x-large @click="btnClick({ red: 255, green: 0, blue: 0 })"> Boost power</v-btn>

            <v-btn class="ma-2" color="purple lighten-2 black--text" elevation="3" value="creativity" x-large @click="btnClick({ red: 174, green: 0, blue: 255 })"> Encourage creativity</v-btn>

            <v-btn class="ma-2" color="orange lighten-2 black--text" elevation="3" value="energy" x-large @click="btnClick({ red: 255, green: 128, blue: 0 })"> Restore energy</v-btn>

            <v-btn class="ma-2" color="light-blue lighten-2 black--text" elevation="3" value="stress" x-large @click="btnClick({ red: 0, green: 204, blue: 255 })"> Reduce stress</v-btn>

            <v-btn class="ma-2" color="yellow lighten-2 black--text" elevation="3" value="positivity" x-large @click="btnClick({ red: 255, green: 230, blue: 0 })"> Stimulate positivity</v-btn>

            <v-btn class="ma-2" color="green lighten-2 black--text" elevation="3" value="progress" x-large @click="btnClick({ red: 0, green: 255, blue: 47 })"> Make progress</v-btn>
        </v-col>
    </v-container>
</template>
<script>
    export default {
        name: 'Optimization',
        components: {},
        methods: {
            btnClick(colorObject) {
                this.$store.dispatch('changeColorOfLights', colorObject);
                this.$router.push({
                    name: 'ProjectRoomView',
                    params: { id: this.id },
                });
            },
        },
        data() {
            return {
                id: this.$router.currentRoute.params.id,
            };
        },
    };
</script>
