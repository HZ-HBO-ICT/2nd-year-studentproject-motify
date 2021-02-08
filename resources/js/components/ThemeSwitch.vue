<template>
    <div>
        <v-switch v-model="checkedValue" :value="$vuetify.theme.dark" @click="switchTheme(false)" />
    </div>
</template>

<script>
    export default {
        name: 'ThemeSwitch',
        data() {
            return {
                checkedValue: false,
                value: false,
            };
        },

        async mounted() {
            const theme = window.matchMedia('(prefers-color-scheme: dark)');

            theme.addEventListener('change', (theme) => {
                if (!localStorage.getItem('motify_theme') && theme.matches) {
                    this.$vuetify.theme.dark = true;
                    this.getTheme();
                }
            });
            this.value = await this.getTheme();
            this.checkedValue = await this.getTheme();
        },

        methods: {
            async switchTheme(skipStorage = false) {
                if (!localStorage.getItem('motify_theme') || localStorage.getItem('motify_theme') && localStorage.getItem('motify_theme').endsWith('dark')) {
                    if (!skipStorage)
                        localStorage.setItem('motify_theme', 'light');
                    return this.$vuetify.theme.dark = false;
                } else {
                    if (!skipStorage)
                        localStorage.setItem('motify_theme', 'dark');
                    return this.$vuetify.theme.dark = true;
                }
            },
            async getTheme() {
                if (localStorage.getItem('motify_theme')) {
                    if (localStorage.getItem('motify_theme').match('dark')) {
                        this.checkedValue = true;
                        return this.$vuetify.theme.dark = true;
                    } else {
                        this.checkedValue = false;
                        return this.$vuetify.theme.dark = false;
                    }
                } else {
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        this.checkedValue = true;
                        return this.$vuetify.theme.dark = true;
                    } else {
                        this.checkedValue = false;
                        return this.$vuetify.theme.dark = false;
                    }
                }
            },
        },
    };
</script>
