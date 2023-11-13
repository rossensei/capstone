<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    users: Number,
    facilities: Number,
    items: Number,
})
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="py-4">
            <div class="w-full sm:px-6 lg:px-8">
                <h2 class="font-semibold text-3xl text-gray-700 leading-tight mb-4">Test</h2>
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="text-gray-700">This is a test page.</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
