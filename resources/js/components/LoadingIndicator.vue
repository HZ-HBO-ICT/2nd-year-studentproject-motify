<template>
    <v-progress-circular :color="getMainLightBlueColor" :size="50" :width="5" class="mx-auto" indeterminate />
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: 'LoadingIndicator',
        computed: mapGetters(['getMainLightBlueColor']),
    };
</script>
