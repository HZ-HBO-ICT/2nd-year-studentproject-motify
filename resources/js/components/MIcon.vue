<template>
    <svg :fill="color" :height="size" :width="size" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg">
        <use v-bind="{ 'xlink:href': svgFullName }" />
    </svg>
</template>

<script>
    export default {
        name: 'MIcon',
        props: {
            name: {
                type: String,
                default: 'camera',
            },
            size: {
                type: Number,
                default: 32,
            },
            color: {
                type: String,
                default: '#FFFFFF',
            },
        },

        computed: {
            svgFullName() {
                return `/img/icons.svg#${this.name}`;
            },
        },
    };
</script>
