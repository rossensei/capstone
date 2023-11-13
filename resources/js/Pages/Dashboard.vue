<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
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

    <AuthenticatedLayout>
        <div class="py-4">
            <div class="w-full sm:px-6 lg:px-8">
                <h2 class="font-semibold text-3xl text-gray-700 leading-tight mb-4">Dashboard</h2>
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-wrap w-full">
                        <div class="min-w-[350px] mb-4 mx-2 flex-1 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                            <h5 class="text-2xl font-bold tracking-tight">{{ users }}</h5>
                            <p class="font-normal text-gray-700 mb-2 ">Total Users </p>
                        </div>

                        <div class="min-w-[350px] mb-4 mx-2 flex-1 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                            <h5 class="text-2xl font-bold tracking-tight">{{ facilities }}</h5>
                            <p class="font-normal text-gray-700 mb-2 ">Total Facilities </p>
                        </div>

                        <div class="min-w-[350px] mb-4 mx-2 flex-1 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                            <h5 class="text-2xl font-bold tracking-tight">{{ items }}</h5>
                            <p class="font-normal text-gray-700 mb-2 ">Total Items </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
