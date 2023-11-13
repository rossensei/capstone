<script setup>
import { Head, Link } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Welcome" />

    <div class="min-h-screen w-full relative overflow-hidden z-10">
        <img src="../Components/images/mdc-background.jpg" alt="mdc-background" class="object-cover z-0 w-full h-full fixed">

        <div class="z-20 absolute top-0 min-h-screen w-full bg-gradient-to-t bg-black opacity-40"></div>
        <div class="z-30 absolute top-0 h-full w-full">
            <div class="max-w-7xl mx-auto">
                <!-- text here -->
                <h1 class="text-5xl uppercase font-bold font-sans text-center text-white">Mater Dei College's Inventory Management System</h1>
            </div>
        </div>
    </div>
</template>

