<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex w-full px-2 py-2 items-center text-sm font-medium leading-5 rounded-md text-white transition duration-150 ease-in-out'
        : 'inline-flex w-full px-2 py-2 items-center text-sm font-medium leading-5 rounded-md hover:bg-[#7290e8] text-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
