<template>
    <v-row>
        <v-col>
            <BuddyCard />
        </v-col>
    </v-row>
</template>

<script>
    import BuddyCard from './components/BuddyCard';

    export default {
        name: 'Dashboard',
        components: { BuddyCard },
        created() {
        },
    };
</script>

<style lang="scss" scoped></style>
