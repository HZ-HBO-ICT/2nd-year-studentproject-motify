<template>
    <transition name="slide-up">
        <div v-if="showBackOnline" class="network-alert">
            <div :class="'content content-' + (onLine ? 'connected' : 'disconnected')" v-text="onLine ? 'Verbinding hersteld' : 'U bent offline'" />
        </div>
    </transition>
</template>

<script>
    export default {
        name: 'NetworkAlert',

        data() {
            return {
                onLine: navigator.onLine,
                showBackOnline: false,
            };
        },

        watch: {
            onLine(v) {
                this.showBackOnline = true;
                setTimeout(() => this.showBackOnline = false, 4500);
            },
        },

        async created() {
            window.addEventListener('online', this.updateOnlineStatus);
            window.addEventListener('offline', this.updateOnlineStatus);
        },

        methods: {
            updateOnlineStatus(e) {
                const { type } = e;
                this.onLine = type === 'online';
            },
        },
    };
</script>

<style lang="scss" scoped>
    .network-alert {
        bottom: calc(64px + var(--sab));
        left: 50%;
        position: fixed;
        z-index: §§;

        .content {
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .12), 0 0 6px rgba(0, 0, 0, .12);
            color: white;
            font-size: 90%;
            font-weight: bold;
            left: -50%;
            padding: 3px 15px;
            position: relative;

            &-connected {
                background-color: lightgreen;
                color: white;
            }

            &-disconnected {
                background-color: darkred;
                color: white;
            }
        }
    }

    .slide-right-enter-active,
    .slide-right-leave-active,
    .slide-left-enter-active,
    .slide-left-leave-active,
    .slide-up-enter-active,
    .slide-up-leave-active {
        position: absolute;
        transition: all 1000ms;
        will-change: transform;
    }

    .slide-right-enter {
        opacity: 0;
        transform: translate3d(-100%, 0, 0);
    }

    .slide-right-leave-active {
        opacity: 0;
        transform: translate3d(100%, 0, 0);
    }

    .slide-up-enter {
        opacity: 0;
        transform: translate3d(0, 200%, 0);
    }

    .slide-up-leave-active {
        opacity: 0;
        transform: translate3d(0, 200%, 0);
    }

    .slide-left-enter {
        opacity: 0;
        transform: translate3d(100%, 0, 0);
    }

    .slide-left-leave-active {
        opacity: 0;
        transform: translate3d(-100%, 0, 0);
    }
</style>
