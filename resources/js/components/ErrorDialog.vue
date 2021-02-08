<template>
    <v-row v-if="error && !loading" class="text-center">
        <v-col cols="12">
            <v-alert color="error" outlined>
                <h1 class="mb-3">
                    <v-icon center color="error" style="font-size: 44px"
                    >mdi-alert-box-outline
                    </v-icon>
                </h1>
                <h3 v-text="error" />
            </v-alert>
        </v-col>
    </v-row>
</template>

<script>
    export default {
        name: 'ErrorDialog',
        props: {
            error: {},
            loading: {},
        },
    };
</script>
